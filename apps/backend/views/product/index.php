<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body">
        <div class="product-index">


            <div style="margin-bottom: 10px">

                <?php echo Html::a('<i class="fa fa-plus"></i> Thêm', ['create'], ['class' => 'btn btn-success']) ?>

                <div class="pull-right">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>

            </div>

            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                'summary' => 'Hiển thị <b>{begin}</b>-<b>{end}</b> trong <b>{totalCount}</b> sản phẩm',
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'headerOptions' => ['class'=>'text-center'],
                        'contentOptions' => ['class'=>'text-center'],
                        'options' => ['style'=>'width:3%']
                    ],
                    [
                        'label' => 'Hình Ảnh',
                        'value' => function($model){
                            if ($model->thumbnail_base_url==null){
                                return '<img src="/img/default.jpg" width="50">';
                            }
                            return '<img src="'.$model->thumbnail_base_url.'/'.$model->thumbnail_path.'" width="50">';
                        },
                        'format' => 'raw',
                        'options' => ['style' => 'width: 15%'],
                    ],
                    [
                        'attribute' => 'name',
                        'options' => ['style' => 'width: 15%'],
                        'value' => function ($model) {
                            return Html::a($model->name, ['update', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'category.name',
                        'options' => ['style' => 'width: 15%'],
                    ],
                    [
                        'attribute' => 'brand.name',
                        'options' => ['style' => 'width: 15%'],
                    ],
                    [
                        'attribute' => 'priority',
                        'options' => ['style' => 'width: 10%'],
                    ],
                    // 'unit_price',
                    // 'discount',
                    // 'star_rating',
                    // 'total_view',
                    // 'status',
                    // 'description:ntext',
                    // 'short_detail:ntext',
                    // 'warranty',
                    // 'group_id',
                    // 'technical_detail:ntext',
                    // 'additional_detail',
                    // 'unit_in_stock',
                    // 'quantity_in_stock',
                    // 'suppiler_id',
                    // 'product_ref',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'options' => ['style' => 'width: 5%'],
                        'template' => '{update} {delete}',
                    ],
                ],
            ]); ?>

        </div>
    </div>
</div>

