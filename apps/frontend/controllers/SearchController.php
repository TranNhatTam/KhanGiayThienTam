<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 19/10/2018
 * Time: 11:19 AM
 */

namespace frontend\controllers;


use common\models\Brand;
use common\models\Category;
use common\models\Product;
use yii\data\Pagination;
use yii\web\Controller;

class SearchController extends Controller
{
    public function actionIndex($filter)
    {
        if ($filter == '') {
            return $this->redirect(['product/index']);
        } else {
            $categories = Category::find()->orderBy(['priority' => SORT_DESC])->visible()->all();
            $brands = Brand::find()->visible()->all();
            $query = Product::find()->where(['OR', ['like', 'name', strtr($filter, ['d' => 'đ', 'D' => 'Đ'])], ['like', 'name', $filter]])->visible();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>18]);
            $product = $query->offset($pages->offset)->limit($pages->limit)->all();
        }
        return $this->render('index', ['categories' => $categories, 'brands' => $brands, 'product' => $product, 'pages' => $pages]);
    }
}