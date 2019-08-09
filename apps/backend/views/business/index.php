<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BusinessSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model common\models\Business */

$this->title = 'Thông tin công ty';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'STT',
            ],
            [
                'header' => 'Logo',
                'value' => function ($model) {
                    if ($model->thumbnail_base_url != null) {
                        return Html::img($model->thumbnail_base_url . '/' . $model->thumbnail_path, ['style' => 'width:50']);
                    } else {
                        return '<img src="/img/default.jpg" width="50">';
                    }
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['update', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            'hot_line',
            'phone',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]); ?>

</div>
