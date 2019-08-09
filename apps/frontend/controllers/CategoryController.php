<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/17/2018
 * Time: 4:55 PM
 */

namespace frontend\controllers;


use common\models\Brand;
use common\models\Category;
use common\models\OrderDetails;
use common\models\Product;
use common\models\Urls;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class CategoryController extends Controller
{
    /**
     * @param $urlId
     * @param $format
     * @return string
     */
    public function actionView($urlId, $format)
    {
        $urls = Urls::find()->where(['id' => $urlId])->andWhere(['type' => Urls::CATEGORY])->one();
        if ($urls) {
            if ($urls->route == 'bestsellers') {
                $catergory = Category::find()->where(['url_id' => $urls->id])->one();
                if ($catergory) {
                    $categories = Category::find()->orderBy(['priority' => SORT_ASC ])->visible()->all();
                    $brands = Brand::find()->visible()->all();
                    $query = Product::find()->where(['category_id' => $catergory->id])->visible();

                    $countQuery = clone $query;
                    $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 18]);
//                    $product = $query->offset($pages->offset)->limit($pages->limit)->all();

//                    $orderDetails = OrderDetails::find()->select("COUNT(*) AS num_order,product_id")->groupBy(['product_id'])->orderBy(['num_order' => SORT_DESC])->limit(20)->all();
//                    $productBestSeller = [];
//                    foreach ($orderDetails as $orderDetail) {
//                        if ($orderDetail->product) {
//                            $productBestSeller[] = $orderDetail->product;
//                        }
//                    }
                    $productBestSeller = Product::find()->orderBy(['priority'=>SORT_DESC])->limit(20)->visible()->all();


                    return $this->render('view', ['categories' => $categories, 'brands' => $brands, 'product' => $productBestSeller, 'pages' => $pages, 'urlId' => $urlId]);
                }
            } else {
                $catergory = Category::find()->where(['url_id' => $urls->id])->one();
                if ($catergory) {
                    $categories = Category::find()->orderBy(['priority' => SORT_DESC])->visible()->all();
                    $brands = Brand::find()->visible()->all();
                    $query = Product::find()->where(['category_id' => $catergory->id])->visible();

                    $countQuery = clone $query;
                    $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 18]);
                    $product = $query->offset($pages->offset)->limit($pages->limit)->all();

                    return $this->render('view', ['categories' => $categories, 'brands' => $brands, 'product' => $product, 'pages' => $pages, 'urlId' => $urlId]);
                }
            }
        }
    }

    /**
     * @param $urlId
     * @param $format
     * @return array
     */
    public function actionSortProductByBrand($urlId, $format)
    {
        Yii::$app->response->format = 'json';
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $urls = Urls::find()->where(['id' => $urlId])->andWhere(['type' => Urls::CATEGORY])->one();
            if ($urls) {
                $catergory = Category::find()->where(['url_id' => $urls->id])->one();
                if ($catergory) {
                    $brand = $request->get('brand');
                    if (!empty($brand)) {
                        $query = Product::find()->where(['category_id' => $catergory->id, 'brand_id' => $brand])->visible();
                    } else {
                        $query = Product::find()->where(['category_id' => $catergory->id])->visible();
                    }
                    $countQuery = clone $query;
                    $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 18]);
                    $product = $query->offset($pages->offset)->limit($pages->limit)->all();

                    return ['data' => $this->renderAjax('list', ['product' => $product, 'pages' => $pages])];
                }

            }

        }
    }
}