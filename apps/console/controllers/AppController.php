<?php

namespace console\controllers;

use backend\models\ProductForm;
use common\models\Brand;
use common\models\Category;
use common\models\CategoryBrand;
use common\models\District;
use common\models\OrderDetails;
use common\models\Orders;
use common\models\Product;
use common\models\ProductImage;
use common\models\ProductTag;
use common\models\Province;
use common\models\Tag;
use common\models\Urls;
use common\models\Ward;
use http\Url;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Module;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;
use yii\httpclient\Client;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class AppController extends Controller
{
    /** @var array */
    public $writablePaths = [
        '@common/runtime',
        '@frontend/runtime',
        '@frontend/web/assets',
        '@backend/runtime',
        '@backend/web/assets',
        '@storage/cache',
        '@storage/web/source',
        '@api/runtime',
    ];

    /** @var array */
    public $executablePaths = [
        '@backend/yii',
        '@frontend/yii',
        '@console/yii',
        '@api/yii',
    ];

    /** @var array */
    public $generateKeysPaths = [
        '@base/.env'
    ];

    /**
     * Sets given keys to .env file
     */
    public function actionSetKeys()
    {
        $this->setKeys($this->generateKeysPaths);
    }

    /**
     * @throws \yii\base\InvalidRouteException
     * @throws \yii\console\Exception
     */
    public function actionSetup()
    {
        $this->runAction('set-writable', ['interactive' => $this->interactive]);
        $this->runAction('set-executable', ['interactive' => $this->interactive]);
        $this->runAction('set-keys', ['interactive' => $this->interactive]);
        \Yii::$app->runAction('migrate/up', ['interactive' => $this->interactive]);
        \Yii::$app->runAction('rbac-migrate/up', ['interactive' => $this->interactive]);
    }

    /**
     * Truncates all tables in the database.
     * @throws \yii\db\Exception
     */
    public function actionTruncate()
    {
        $dbName = Yii::$app->db->createCommand('SELECT DATABASE()')->queryScalar();
        if ($this->confirm('This will truncate all tables of current database [' . $dbName . '].')) {
            Yii::$app->db->createCommand('SET FOREIGN_KEY_CHECKS=0')->execute();
            $tables = Yii::$app->db->schema->getTableNames();
            foreach ($tables as $table) {
                $this->stdout('Truncating table ' . $table . PHP_EOL, Console::FG_RED);
                Yii::$app->db->createCommand()->truncateTable($table)->execute();
            }
            Yii::$app->db->createCommand('SET FOREIGN_KEY_CHECKS=1')->execute();
        }
    }

    /**
     * Drops all tables in the database.
     * @throws \yii\db\Exception
     */
    public function actionDrop()
    {
        $dbName = Yii::$app->db->createCommand('SELECT DATABASE()')->queryScalar();
        if ($this->confirm('This will drop all tables of current database [' . $dbName . '].')) {
            Yii::$app->db->createCommand("SET foreign_key_checks = 0")->execute();
            $tables = Yii::$app->db->schema->getTableNames();
            foreach ($tables as $table) {
                $this->stdout('Dropping table ' . $table . PHP_EOL, Console::FG_RED);
                Yii::$app->db->createCommand()->dropTable($table)->execute();
            }
            Yii::$app->db->createCommand("SET foreign_key_checks = 1")->execute();
        }
    }

    /**
     * @param string $charset
     * @param string $collation
     * @throws \yii\base\ExitException
     * @throws \yii\base\NotSupportedException
     * @throws \yii\db\Exception
     */
    public function actionAlterCharset($charset = 'utf8mb4', $collation = 'utf8mb4_unicode_ci')
    {
        if (Yii::$app->db->getDriverName() !== 'mysql') {
            Console::error('Only mysql is supported');
            Yii::$app->end(1);
        }

        if (!$this->confirm("Convert tables to character set {$charset}?")) {
            Yii::$app->end();
        }

        $tables = Yii::$app->db->getSchema()->getTableNames();
        Yii::$app->db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
        foreach ($tables as $table) {
            $command = Yii::$app->db->createCommand("ALTER TABLE {$table} CONVERT TO CHARACTER SET :charset COLLATE :collation")->bindValues([
                ':charset' => $charset,
                ':collation' => $collation
            ]);
            $command->execute();
        }
        Yii::$app->db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
        Console::output('All ok!');
    }


    /**
     * Adds write permissions
     */
    public function actionSetWritable()
    {
        $this->setWritable($this->writablePaths);
    }

    /**
     * Adds execute permissions
     */
    public function actionSetExecutable()
    {
        $this->setExecutable($this->executablePaths);
    }

    /**
     * @param $paths
     */
    private function setWritable($paths)
    {
        foreach ($paths as $writable) {
            $writable = Yii::getAlias($writable);
            Console::output("Setting writable: {$writable}");
            @chmod($writable, 0777);
        }
    }

    /**
     * @param $paths
     */
    private function setExecutable($paths)
    {
        foreach ($paths as $executable) {
            $executable = Yii::getAlias($executable);
            Console::output("Setting executable: {$executable}");
            @chmod($executable, 0755);
        }
    }

    /**
     * @param $paths
     */
    private function setKeys($paths)
    {
        foreach ($paths as $file) {
            $file = Yii::getAlias($file);
            Console::output("Generating keys in {$file}");
            $content = file_get_contents($file);
            $content = preg_replace_callback('/<generated_key>/', function () {
                $length = 32;
                $bytes = openssl_random_pseudo_bytes(32, $cryptoStrong);
                return strtr(substr(base64_encode($bytes), 0, $length), '+/', '_-');
            }, $content);
            file_put_contents($file, $content);
        }
    }

    private function insertUrl($route, $type, $seo, $create_at)
    {
        $url = new Urls();
        $url->route = $route;
        $url->type = $type;
        $url->seo = $seo;
        $url->created_at = $create_at;
        if ($url->validate()) {
            $url->save();
            return $url->id;
        }
        return -1;
    }

    public function actionSyncHaravanOrder()
    {
        $http = $this->getHttpInstance();
        // orders
        $count = 0;
        $total = $http->get('orders/count.json')->send()->getData();
        for ($i = 1; $i <= ceil($total['count'] / 50); $i++) {
            $list = $http->get(['orders.json', 'page' => $i])->send()->getData();

            foreach ($list['orders'] as $o) {
                $ship_name = '';
                $ship_phone = '';
                $ship_city = '';
                $ship_district = '';
                $ship_ward = '';
                $ship_address = '';
                if ($o['billing_address']['name'] != null) {
                    $ship_name = $o['billing_address']['name'];
                }
                if ($o['billing_address']['phone'] != null) {
                    $ship_phone = $o['billing_address']['phone'];
                }
                if ($o['billing_address']['province'] != null) {
                    $ship_city = $o['billing_address']['province'];
                }
                if ($o['billing_address']['district'] != null) {
                    $ship_district = $o['billing_address']['district'];
                }
                if ($o['billing_address']['ward'] != null) {
                    $ship_ward = $o['billing_address']['ward'];
                }
                if ($o['billing_address']['address1'] != null) {
                    $ship_address = $o['billing_address']['address1'];
                }

                $order = new Orders();
                $order->freight = 0;
                $order->total_price = $o['total_price'];
                $order->total_tax = $o['total_tax'];
                $order->status = $o['financial_status'];
                $order->order_date = date('Y-m-d H:i:s', strtotime($o['created_at']));
                $order->tax = (string)$o['total_tax'];
                $order->ship = (string)array_sum(array_column($o['shipping_lines'], 'price'));
                $order->billing_address = json_encode($o['billing_address']);
                $order->type = $o['gateway_code'];
                $order->description = $o['gateway'];
                $order->ship_name = $ship_name;
                $order->ship_phone = $ship_phone;
                $order->ship_city = $ship_city;
                $order->ship_district = $ship_district;
                $order->ship_ward = $ship_ward;
                $order->ship_address = $ship_address;


                if ($order->validate() && $order->save()) {
//                    var_dump($order);
                    var_dump('number order ' . $count);
                    $count++;
                } else {
                    var_dump($order->getErrors());
                    die;
                }
                $count1 = 0;
                foreach ($o['line_items'] as $order_item) {
                    $product = Product::find()->where(['code' => $order_item['product_id']])->one();
                    $productID = 0;
                    if ($product) {
                        $productID = $product->id;
                    }
                    if ($productID == 0) {
                        continue;
                    }
                    $order_detail = new OrderDetails();
                    $order_detail->order_id = $order->id;
                    $order_detail->product_id = $productID;
                    $order_detail->unit_price = $order_item['price'];
                    $order_detail->product_code = (string)$order_item['product_id'];
                    $order_detail->quantity = $order_item['quantity'];
                    $order_detail->tax_value = 0;
                    $order_detail->discount = $order_item['total_discount'];
                    $order_detail->weight = $order_item['grams'];
                    $order_detail->total_price = $order_detail->unit_price * $order_detail->quantity;

                    if ($order_detail->validate() && $order_detail->save()) {
                        var_dump('number order detail ' . $count1);
                        $count1++;
                    } else {
                        var_dump($order_detail->getErrors());
                        die;
                    }
                }
                var_dump('ssss');
            }
        }

    }

    public function actionSyncHaravanCategories()
    {
        $http = $this->getHttpInstance();
        $collections = $http->get('custom_collections.json')->send()->getData();
        // categories
        foreach ($collections['custom_collections'] as $collection) {
            $imgName = Uuid::uuid4()->toString() . '.' . pathinfo($collection['image']['src'], PATHINFO_EXTENSION);
            $result = $this->insertUrl($collection['handle'], Urls::CATEGORY, '{}', time());
            if ($result == -1) break;
            if ($collection['image']['src']) {
                if (!is_dir(Yii::getAlias('@storage/web/source/images'))) {
                    mkdir(Yii::getAlias('@storage/web/source/images'));
                }
                if (!is_dir(Yii::getAlias('@storage/web/source/images/categories'))) {
                    mkdir(Yii::getAlias('@storage/web/source/images/categories'));
                }
                file_put_contents(Yii::getAlias('@storage/web/source/images/categories/' . $imgName), file_get_contents($collection['image']['src']));
            }
            $category = new Category();
            $category->url_id = $result;
            $category->name = $collection['title'];
            $category->priority = 0;
            $category->description = '';
            $category->thumbnail = [
                'path' => 'images/categories/' . $imgName,
                'name' => $imgName,
                'size' => '104514',
                'type' => 'image/jpeg',
                'order' => "",
                'base_url' => Yii::getAlias('@storageUrl/source')
            ];
            $category->group_id = Category::GROUP_NORMAL;
            $category->save();
        }
        var_dump('ss');
    }

    public function actionSyncHaravanProducts()
    {
        $http = $this->getHttpInstance();
        $total = $http->get('products/count.json')->send()->getData();
        for ($i = 1; $i <= ceil($total['count'] / 50); $i++) {
            $products = $http->get(['products.json', 'page' => $i])->send()->getData();
            foreach ($products['products'] as $product) {
                $brand = Brand::find()->where(['name' => $product['vendor']])->one();
                if ($brand == null) {
                    $brands = new Brand();
                    $brands->name = $product['vendor'];
                    $brands->brand_image = $product['vendor'];
                    $brands->save();
                }
            }
        }
        $count = 0;
        $description = '';
        for ($i = 1; $i <= ceil($total['count'] / 50); $i++) {
            //var_dump('count: ' . $total['count']);

            $products = $http->get(['products.json', 'page' => $i])->send()->getData();

            foreach ($products['products'] as $product) {
                var_dump('number product' . $count);
                $result = $this->insertUrl($product['handle'], Urls::PRODUCT, '{}', time());
                if ($result == -1) break;
                if ($product['images']) {
                    foreach ($product['images'] as $image) {
                        $imgName = Uuid::uuid4()->toString() . '.' . pathinfo($image['src'], PATHINFO_EXTENSION);
                        if ($image['src']) {
                            if (!is_dir(Yii::getAlias('@storage/web/source/images/products'))) {
                                mkdir(Yii::getAlias('@storage/web/source/images/products'));
                            }
                            file_put_contents(Yii::getAlias('@storage/web/source/images/products/' . $imgName), file_get_contents($image['src']));
                        }
                    }
                }
                $categoryID = -1;
                $brandID = -1;
                $category1 = Category::find()->where(['like', 'name', $product['product_type']])->one();
                if ($category1) {
                    $categoryID = $category1->id;
                }
                if ($categoryID == -1) {
                    $productType = $product['product_type'];
                    //var_dump($productType);
                    //var_dump($product['title']);
                    if ($productType == 'Cafe') {
                        $category2 = Category::find()->where(['like', 'name', 'Cà phê'])->one();
                        $categoryID = $category2->id;
                    } else if ($productType == 'Hạt thủy tinh') {
                        $category3 = Category::find()->where(['like', 'name', 'Topping'])->one();
                        $categoryID = $category3->id;
                    } else if ($productType == 'Vải hộp') {
                        $category4 = Category::find()->where(['like', 'name', 'Đào hộp'])->one();
                        $categoryID = $category4->id;
                    } else if ($productType == 'Nhựa') {
                        $category5 = Category::find()->where(['like', 'name', 'Ly'])->one();
                        $categoryID = $category5->id;
                    }
                }
                $brand1 = Brand::find()->where(['name' => $product['vendor']])->one();
                if ($brand1) {
                    $brandID = $brand1->id;
                }

                if ($product['body_html'] != null) {
                    $description = $product['body_html'];
                }
                $productNew = new ProductForm();
                $productNew->name = $product['title'];
                $productNew->code = $product['variants'][0]['product_id'];;
                $productNew->url_id = $result;
                $productNew->description = $description;
                $productNew->short_detail = $product['title'];
                $productNew->unit_price = $product['variants'][0]['price'];
                $productNew->weight = $product['variants'][0]['grams'];
                $productNew->category_id = $categoryID;
                $productNew->brand_id = $brandID;
                $productNew->unit_in_stock = 0;
                $productNew->quantity_in_stock = 0;
                $productNew->thumbnail = [
                    'path' => 'images/products/' . $imgName,
                    'name' => $imgName,
                    'size' => '104514',
                    'type' => 'image/jpeg',
                    'order' => "",
                    'base_url' => Yii::getAlias('@storageUrl/source')
                ];
                if ($productNew->validate() && $productNew->save()) {
                    $count++;
                    var_dump('save product ' . $count);
                    foreach (explode(',', $product['tags']) as $tag) {
                        if ($tag !== '') {
                            $result = $this->insertUrl(Inflector::slug($tag), Urls::TAG, '{}', time());
                            if ($result == -1) {
                                $result=Urls::find()->where(['route'=>Inflector::slug($tag)])->one();
                                $result=$result->id;                            }
                            $tagNew = new Tag();
                            $tagNew->url_id = $result;
                            $tagNew->name = $tag;
                            $tagNew->priority = 0;
                            if ($tagNew->validate() && $tagNew->save()) {
                                var_dump('tag ss');
                                $productTag = new ProductTag();
                                $productTag->product_id = $productNew->id;
                                $productTag->tag_name = $tag;
                                if ($productTag->validate() && $productTag->save()) {
                                    var_dump('producttag ss');
                                } else {
                                    var_dump('product tag ' . $productTag->getErrors());
                                    die;
                                }
                            } else {
                                var_dump('tag ' . $tagNew->getErrors());
                                die;
                            }
                        }
                    }

                } else {
                    var_dump('product ' . $productNew->getErrors());
                    die;
                }
            }
        }
    }

    public function actionSyncHaravan()
    {
        $categories = [];
        $items = [];
        $tags = [];
        $http = $this->getHttpInstance();
        $collections = $http->get('custom_collections.json')->send()->getData();
        // categories
        foreach ($collections['custom_collections'] as $collection) {
            $imgName = Uuid::uuid4()->toString() . '.' . pathinfo($collection['image']['src'], PATHINFO_EXTENSION);
            $result = $this->insertUrl($collection['handle'], Urls::CATEGORY, '{}', time());
            if ($result == -1) break;
            if ($collection['image']['src']) {
                if (!is_dir(Yii::getAlias('@storage/web/source/images'))) {
                    mkdir(Yii::getAlias('@storage/web/source/images'));
                }
                if (!is_dir(Yii::getAlias('@storage/web/source/images/categories'))) {
                    mkdir(Yii::getAlias('@storage/web/source/images/categories'));
                }
                file_put_contents(Yii::getAlias('@storage/web/source/images/categories/' . $imgName), file_get_contents($collection['image']['src']));
            }
            $category = new Category();
            $category->url_id = $result;
            $category->name = $collection['title'];
            $category->priority = 0;
            $category->description = '';
            $category->thumbnail = [
                'path' => 'images/categories/' . $imgName,
                'name' => $imgName,
                'size' => '104514',
                'type' => 'image/jpeg',
                'order' => "",
                'base_url' => Yii::getAlias('@storageUrl/source')
            ];
            $category->group_id = Category::GROUP_NORMAL;
            $category->save();
        }
        // items
        $total = $http->get('products/count.json')->send()->getData();
        for ($i = 1; $i <= ceil($total['count'] / 50); $i++) {
            $products = $http->get(['products.json', 'page' => $i])->send()->getData();
            foreach ($products['products'] as $product) {
                $brand = Brand::find()->where(['name' => $product['vendor']])->one();
                if ($brand == null) {
                    $brands = new Brand();
                    $brands->name = $product['vendor'];
                    $brands->brand_image = $product['vendor'];
                    $brands->save();
                }
            }
        }
        $count = 0;
        $description = '';
        for ($i = 1; $i <= ceil($total['count'] / 50); $i++) {
            var_dump('count: ' . $total['count']);

            $products = $http->get(['products.json', 'page' => $i])->send()->getData();

            foreach ($products['products'] as $product) {
                var_dump('number product' . $count);
                $result = $this->insertUrl($product['handle'], Urls::PRODUCT, '{}', time());
                if ($result == -1) break;
//                $images = [];
                if ($product['images']) {
                    foreach ($product['images'] as $image) {
                        $imgName = Uuid::uuid4()->toString() . '.' . pathinfo($image['src'], PATHINFO_EXTENSION);
//                    $images[] = $imgName;
                        if ($image['src']) {
                            if (!is_dir(Yii::getAlias('@storage/web/source/images/products'))) {
                                mkdir(Yii::getAlias('@storage/web/source/images/products'));
                            }
                            file_put_contents(Yii::getAlias('@storage/web/source/images/products/' . $imgName), file_get_contents($image['src']));
                        }
                    }
                }
                $categoryID = -1;
                $brandID = -1;
                $category1 = Category::find()->where(['like', 'name', $product['product_type']])->one();
                if ($category1) {
                    $categoryID = $category1->id;
                }
                $brand1 = Brand::find()->where(['name' => $product['vendor']])->one();
                if ($brand1) {
                    $brandID = $brand1->id;
                }

                if ($product['body_html'] != null) {
                    $description = $product['body_html'];
                }
                $productNew = new ProductForm();
                $productNew->name = $product['title'];
                $productNew->code = $product['variants'][0]['product_id'];;
                $productNew->url_id = $result;
                $productNew->description = $description;
                $productNew->short_detail = $product['title'];
                $productNew->unit_price = $product['variants'][0]['price'];
                $productNew->weight = $product['variants'][0]['grams'];
                $productNew->category_id = $categoryID;
                $productNew->brand_id = $brandID;
                $productNew->unit_in_stock = 0;
                $productNew->quantity_in_stock = 0;
                $productNew->thumbnail = [
                    'path' => 'images/products/' . $imgName,
                    'name' => $imgName,
                    'size' => '104514',
                    'type' => 'image/jpeg',
                    'order' => "",
                    'base_url' => Yii::getAlias('@storageUrl/source')
                ];
                if ($productNew->validate() && $productNew->save()) {
                    $count++;
                    var_dump('save product ' . $count);
                    foreach (explode(',', $product['tags']) as $tag) {
                        if ($tag !== '') {
                            $result = $this->insertUrl(Inflector::slug($tag), Urls::TAG, '{}', time());
                            if ($result == -1) break;
                            $tagOld = Tag::find()->where(['name' => $tag])->one();
                            if ($tagOld == null) {
                                $tagNew = new Tag();
                                $tagNew->url_id = $result;
                                $tagNew->name = $tag;
                                $tagNew->priority = 0;
                                if ($tagNew->validate() && $tagNew->save()) {
                                    var_dump('tag ss');
                                    $productTag = new ProductTag();
                                    $productTag->product_id = $productNew->id;
                                    $productTag->tag_name = $tag;
                                    if ($productTag->validate() && $productTag->save()) {
                                        var_dump('producttag ss');
                                    } else {
                                        var_dump($productTag->getErrors());
                                        die;
                                    }
                                } else {
                                    var_dump($tagNew->getErrors());
                                    die;
                                }
                            }
                        }
                    }

                } else {
                    var_dump($productNew->getErrors());
                    die;
                }

//                $id = $this->db->getSchema()->lastInsertID;
//
//                $items[$product['id']] = $id;
//
//                foreach (explode(',', $product['tags']) as $tag) {
//                    if ($tag !== '') {
//                        $tags[$tag][] = $id;
//                    }
//                }
            }
        }
        exit;
        // tags
        $newTags = [];
        foreach ($tags as $tag => $tagItems) {
            $newTags[$this->db->getSchema()->lastInsertID] = $tagItems;
        }

        // items_tags
        foreach ($newTags as $tag => $tagItems) {
            foreach ($tagItems as $tagItem) {
            }
        }

        // items_categories
        $collects = $http->get(['collects.json', 'limit' => 500])->send()->getData();
        foreach ($collects['collects'] as $collect) {
        }

        // orders
        $total = $http->get('orders/count.json')->send()->getData();
        for ($i = 1; $i <= ceil($total['count'] / 50); $i++) {
            $list = $http->get(['orders.json', 'page' => $i])->send()->getData();

            foreach ($list['orders'] as $o) {

                $lis = array_filter($o['line_items'], function ($li) use ($items) {
                    return isset($items[$li['product_id']]);
                });

                if (!empty($lis)) {

                    $oid = $this->db->getSchema()->lastInsertID;

                    foreach ($lis as $li) {
                    }
                }
            }
        }

        return true;
    }

    /**
     * @return Client
     */
    protected function getHttpInstance()
    {
        return new Client([
            'transport' => [
                'class' => 'yii\httpclient\CurlTransport'
            ],
            'requestConfig' => [
                'format' => Client::FORMAT_JSON,
                'options' => [
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_HTTPAUTH => CURLAUTH_BASIC | CURLAUTH_DIGEST,
                    CURLOPT_USERPWD => '8d5aa595d670b44ddd9d057ce485c540:7705e3139249d7ae60096fb7e824af2f'
                ]
            ],
            'baseUrl' => 'https://nguyenlieuphachesi.myharavan.com/admin'
        ]);
    }

    public function actionInitVietnamAddress()
    {
        $filename = "VN_tree.json";
        $file_read = file_get_contents($filename);
        $data = json_decode($file_read);
        foreach ($data as $key => $province) {
            $provinceModel = new Province();
            $provinceModel->id = $key;
            $provinceModel->name = $province->name;
            $provinceModel->type = $province->type;
            if ($provinceModel->validate() && $provinceModel->save()) {
                echo "------------Inserted PROVINCE:{$provinceModel->name}..." . PHP_EOL;
            }
            $districtList = $province->{'quan-huyen'};
            foreach ($districtList as $key1 => $district) {
                $districtModel = new District();
                $districtModel->id = $key1;
                $districtModel->name = $district->name;
                $districtModel->type = $district->type;
                $districtModel->location = $district->path_with_type;
                $districtModel->province_id = $district->parent_code;
                if ($districtModel->validate() && $districtModel->save()) {
                    echo "------Inserted DISTRICT:{$districtModel->name}..." . PHP_EOL;
                }
                $wardList = $district->{'xa-phuong'};
                foreach ($wardList as $key2 => $ward) {
                    $wardModel = new Ward();
                    $wardModel->id = $key2;
                    $wardModel->name = $ward->name;
                    $wardModel->type = $ward->type;
                    $wardModel->location = $ward->path_with_type;
                    $wardModel->district_id = $ward->parent_code;
                    if ($wardModel->validate() && $wardModel->save()) {
                        echo "---Inserted WARD:{$ward->name}..." . PHP_EOL;
                    }
                }

            }

        }

    }

    public function actionSyncHaravanAll()
    {
        Yii::$app->db->createCommand()->truncateTable('category')->execute();
        Yii::$app->db->createCommand()->truncateTable('brand')->execute();
        Yii::$app->db->createCommand()->truncateTable('category_brand')->execute();
        Yii::$app->db->createCommand()->truncateTable('product')->execute();
        Yii::$app->db->createCommand()->truncateTable('tag')->execute();
        Yii::$app->db->createCommand()->truncateTable('product_tag')->execute();
        Yii::$app->db->createCommand()->truncateTable('urls')->execute();
        Yii::$app->db->createCommand()->truncateTable('orders')->execute();
        Yii::$app->db->createCommand()->truncateTable('order_details')->execute();

        $this->actionSyncHaravanCategories();
        $this->actionSyncHaravanProducts();
        $this->actionSyncHaravanOrder();

    }
}
