<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\OrdersDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-detail-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Orders Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            'product_id',
            'unit_price',
            'quantity',
            // 'tax_value',
            // 'discount',
            // 'total_price',
            // 'note:ntext',
            // 'created_at',
            // 'updated_at',
            // 'is_deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
