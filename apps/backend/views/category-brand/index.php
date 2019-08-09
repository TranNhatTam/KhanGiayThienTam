<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Category;
use common\models\Brand;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoryBrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category Brands';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-brand-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Category Brand', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    $category=Category::find()->where(['id'=>$model->category_id])->one();
                   return $category->name;
                },
                'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
            ],

            [
                'attribute' => 'brand_id',
                'value' => function ($model) {
                    $brand=Brand::find()->where(['id'=>$model->brand_id])->one();
                    return $brand->name;
                },
                'filter' => ArrayHelper::map(Brand::find()->all(), 'id', 'name'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
