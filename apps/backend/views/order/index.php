<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_id',
            'employee_id',
            'order_date',
            'ship_date',
            // 'fee_info:ntext',
            // 'billing_info:ntext',
            // 'payment_info:ntext',
            // 'shipper_id',
            // 'freight',
            // 'ship_name',
            // 'ship_phone',
            // 'ship_email:email',
            // 'ship_address',
            // 'ship_city',
            // 'ship_district',
            // 'ship_ward',
            // 'ship_postcode',
            // 'ship_country',
            // 'total_price',
            // 'total_tax',
            // 'status',
            // 'ship_status',
            // 'payment_status',
            // 'note:ntext',
            // 'payment_type',
            // 'notification_type',
            // 'created_at',
            // 'updated_at',
            // 'is_deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
