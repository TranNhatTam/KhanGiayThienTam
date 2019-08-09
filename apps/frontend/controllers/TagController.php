<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 22/10/2018
 * Time: 12:52 PM
 */

namespace frontend\controllers;


use common\models\Brand;
use common\models\Category;
use common\models\Product;
use common\models\ProductTag;
use common\models\Tag;
use common\models\Urls;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class TagController extends Controller
{
    public function actionView($urlId)
    {
        if ($urlId){
            $categories = Category::find()->orderBy(['priority' => SORT_DESC])->visible()->all();
            $brands = Brand::find()->visible()->all();
            $urls = Urls::find()->where(['id' => $urlId])->andWhere(['type' => Urls::TAG])->one();
            $tag=Tag::find()->where(['url_id'=>$urls->id])->one();
            $productTags=ProductTag::find()->where(['tag_name'=>$tag->name])->all();
            $products=[];
            foreach ($productTags as $product){
                $products[]=$product->product;
            }
            return $this->render('index', ['categories' => $categories, 'brands' => $brands, 'products'=>$products]);
        }

    }
}