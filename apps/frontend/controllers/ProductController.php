<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/16/2018
 * Time: 2:07 PM
 */

namespace frontend\controllers;


use common\models\Brand;
use common\models\Category;
use common\models\Product;
use common\models\ProductTag;
use common\models\Tag;
use common\models\Urls;
use frontend\models\CartItem;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $categories = Category::find()->orderBy(['priority' => SORT_DESC])->visible()->all();
        $brands = Brand::find()->visible()->all();

        $category_id = Yii::$app->request->get('category');
        $query = Product::find()->visible();
        if (isset($category_id)) {
            $query = Product::find()->where(['category_id' => $category_id])->visible();
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>18]);
        $product = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['categories' => $categories, 'brands' => $brands, 'product' => $product, 'pages' => $pages]);
    }

    public function actionSortProductByBrand()
    {
        Yii::$app->response->format = 'json';
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $brand = $request->get('brand');
            $query = Product::find()->where(['brand_id' => $brand])->visible();
            if (!empty($brand)) {
                $query = Product::find()->where(['brand_id' => $brand])->visible();
            } else {
                $query = Product::find()->visible();
            }
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>18]);
            $product = $query->offset($pages->offset)->limit($pages->limit)->all();

            return ['data' => $this->renderAjax('list', ['product' => $product, 'pages' => $pages])];
        }
    }

    public function actionSortProductByCategory()
    {
        Yii::$app->response->format = 'json';
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $category = $request->get('category');
            if ($category != null) {
                $query = Product::find()->where(['category_id' => $category])->visible();
            } else {
                $query = Product::find()->visible();
            }
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>18]);
            $product = $query->offset($pages->offset)->limit($pages->limit)->all();

            return ['data' => $this->renderAjax('list', ['product' => $product, 'pages' => $pages])];
        }
    }


    public function actionView($urlId, $format)
    {
        $urls = Urls::find()->where(['id' => $urlId])->andWhere(['type' => Urls::PRODUCT])->one();
        if ($urls) {
            $product = Product::find()->where(['url_id' => $urls->id])->visible()->one();

            $productTag = ProductTag::find()->where(['product_id' => $product->id])->all();
            $product_df = Product::find()->where(['category_id' => $product->category_id])->andWhere(['!=', 'id', $product->id])->visible()->all();

            // Add Product to Recently View
            $recentlyViewContainer = Yii::$app->recentlyProdView;
            $productRecentlyList = $recentlyViewContainer->getItems();
            $canAddNew = true;
            /** @var Product $item */
            foreach ($productRecentlyList as $key => $item) {
                if ($item->id == $product->id) {
                    $recentlyViewContainer->remove($key);
                    $recentlyViewContainer->addItem($product);
                    $recentlyViewContainer-> save();
                    $canAddNew = false;
                    break;
                }

            }
            if ($canAddNew) {
                $recentlyViewContainer->addItem($product);
                $recentlyViewContainer->save();
            }
        }

        return $this->render('view', ['product' => $product, 'productTag' => $productTag, 'product_df' => $product_df]);
    }

    public function setProductView($id)
    {
        $session = Yii::$app->session;

    }

    public function actionSearchBrand()
    {
        Yii::$app->response->format = 'json';
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $name = $request->get('name');
            $brands = Brand::find()->where(['like', 'name', $name])->visible()->all();

            return ['data' => $this->renderAjax('list-brand', ['brands' => $brands])];
        }
    }

    public function actionSetCookie()
    {
        $cookies = Yii::$app->response->cookies;

        $cookies->add(new \yii\web\Cookie([
            'name' => 'abc',
            'value' => 'xyz',
            'expire' => time() + 86400 * 365,
        ]));

        echo 'Cookie set!';
    }

    public function actionGetCookie()
    {
        $cookies1 = Yii::$app->request->cookies;

        if ($cookies1->has('abc'))
            $cookieValue = $cookies1->getValue('abc');

        echo 'value : ' . $cookieValue;
    }

    public function actionQuickView($id)
    {
        Yii::$app->response->format = 'json';
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $id = $request->get('id');
            $product = Product::find()->where(['id'=>$id])->one();
            if ($product) {
                return ['result'=>$this->renderAjax('quick-view',['product'=>$product])];
            }
        }
    }


}