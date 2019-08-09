<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nhãn';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div style="margin-bottom: 10px">

        <?php echo Html::a('<i class="fa fa-plus"></i> Thêm', ['create'], ['class' => 'btn btn-success']) ?>

        <div class="pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>

    </div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Hiển thị <b>{begin}</b>-<b>{end}</b> trong <b>{totalCount}</b> Tag',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'url_id:url',
            [
                'attribute' => 'name',
                'value' => function($model){
                    return Html::a($model->name, ['update', 'id'=>$model->id]);
                },
                'format' => 'raw',

            ],
//            'url:url',
//            'group_id',
             'priority',
            // 'is_deleted',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

</div>
