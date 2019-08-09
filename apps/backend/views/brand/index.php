<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nhà sản xuất';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body">
        <div class="brand-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <div style="margin-bottom: 10px">

                <?php echo Html::a('<i class="fa fa-plus"></i> Thêm', ['create'], ['class' => 'btn btn-success']) ?>

                <div class="pull-right">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>

            </div>

            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => 'Hiển thị <b>{begin}</b>-<b>{end}</b> trong <b>{totalCount}</b> nhóm sản phẩm',
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'contentOptions' => ['class'=>'text-center'],
                        'headerOptions' => ['class'=>'text-center'],
                        'options' => ['style'=>'width:3%']
                    ],
                    [
                        'format' => 'raw',
                        'contentOptions' => ['class'=>'text-center'],
                        'value' => function($model){
                            if ($model->thumbnail_base_url==null){
                                return '<img src="/img/default.jpg" width="50">';
                            }
                            return '<img src="'.$model->thumbnail_base_url.'/'.$model->thumbnail_path.'" width="50">';
                        }
                    ],
                    [
                        'attribute' => 'name',
                        'value' => function ($model) {
                            return Html::a($model->name, ['update', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    'description:html',
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

