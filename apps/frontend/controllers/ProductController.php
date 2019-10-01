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
use common\models\Url;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $category = Category::find()->visible()->all();
        $query = Product::find()->visible();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 18]);
        $product = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', [
            'category' => $category,
            'product' => $product,
            'pages' => $pages
        ]);
    }

    public function actionQuickView($id)
    {
        Yii::$app->response->format = 'json';
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $id = $request->get('id');
            $product = Product::findOne($id);
            if ($product) {
                return ['result' => $this->renderAjax('_quick-view', ['product' => $product])];
            }
        }
        return $this->redirect('index');
    }

    public function actionView($urlId, $format)
    {
        $url = Url::find()->where(['id' => $urlId])->andWhere(['type' => Url::TYPE_PRODUCT])->one();
        if ($url) {
            $product = Product::find()->where(['url_id' => $url->id])->visible()->one();
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
                    $recentlyViewContainer->save();
                    $canAddNew = false;
                    break;
                }

            }
            if ($canAddNew) {
                $recentlyViewContainer->addItem($product);
                $recentlyViewContainer->save();
            }
        }

        return $this->render('view', ['product' => $product, 'productRelates' => $product_df]);
    }
}