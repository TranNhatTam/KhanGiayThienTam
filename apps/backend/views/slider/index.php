<?php

use common\grid\EnumColumn;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Slider;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sliders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Slider', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'STT',
                'contentOptions' => ['class'=>'text-center'],
                'headerOptions' => ['class'=>'text-center'],
            ],
            [
                'format' => 'raw',
                'header' => 'Thumbnail',
                'contentOptions' => ['class'=>'text-center'],
                'headerOptions' => ['class'=>'text-center'],
                'value' => function($model){
                    if ($model->thumbnail_base_url==null){
                        return '<img src="/img/default.jpg" width="50">';
                    }
                    return '<img src="'.$model->thumbnail_base_url.'/'.$model->thumbnail_path.'" width="50">';
                }
            ],
            [
                'attribute' => 'title',
                'value' => function($model){
                    return Html::a($model->title, ['update', 'id'=>$model->id]);
                },
                'format' => 'raw',
            ],
            [
                'class' => EnumColumn::class,
                'attribute' => 'status',
                'options' => ['style' => 'width: 10%'],
                'enum' => Slider::statuses(),
                'filter' => Slider::statuses(),
            ],
            [
                'attribute' => 'published_at',
                'options' => ['style' => 'width: 15%'],
                'format' => 'datetime',
                'filter' => DateTimeWidget::widget([
                    'model' => $searchModel,
                    'attribute' => 'published_at',
                    'phpDatetimeFormat' => 'dd.MM.yyyy',
                    'momentDatetimeFormat' => 'DD.MM.YYYY',
                    'clientEvents' => [
                        'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")'),
                    ],
                ]),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

</div>
