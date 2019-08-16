<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'thumbnail_path',
            'thumbnail_base_url:url',
            'unit_price',
            // 'unit_in_stock',
            // 'quantity_in_stock',
            // 'discount',
            // 'star_rating',
            // 'total_view',
            // 'warranty',
            // 'short_detail:ntext',
            // 'description:ntext',
            // 'technical_detail:ntext',
            // 'additional_detail:ntext',
            // 'status',
            // 'priority',
            // 'created_at',
            // 'updated_at',
            // 'is_deleted',
            // 'brand_id',
            // 'category_id',
            // 'url_id:url',
            // 'images:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
