<?php

use common\models\Orders;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Đơn hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body">
        <div class="orders-index">


            <div style="margin-bottom: 10px">
                <?=Html::a('Thêm',['create'],['class'=>'btn btn-success'])?>

                <div class="pull-right">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>

            </div>

            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                'summary' => 'Hiển thị <b>{begin}</b>-<b>{end}</b> trong <b>{totalCount}</b> đơn hàng',
                'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
                    [
                        'attribute' => 'id',
                        'format' => 'raw',
                        'value' => function($model){
                            return '<a href="view?id='.$model->id.'">#'.$model->id.'</a>';
                        }
                    ],
//            'customer_id',
//            'employee_id',
                    'order_date',
                    'ship_name',
                    [
                        'attribute' => 'ship_status',
                        'format' => 'raw',
                        'value' => function($model){
                            if ($model->ship_status == Orders::SHIP_STATUS_NOTDELIVERY){
                                return '<span style="border-radius: 5px;padding: 5px;color: #fff;background: #0aa699">Chưa giao</span>';
                            } else {
                                return '<span style="border-radius: 5px;padding: 5px;color: #fff;background: #0aa699">Đã giao</span>';
                            }

                        }
                    ],
                    [
                        'attribute' => 'payment_status',
                        'format' => 'raw',
                        'value' => function($model){
                            if ($model->payment_status == Orders::PAYMENT_STATUS_NOTPAYING){
                                return '<span style="border-radius: 5px;padding: 5px;color: #5e5e5e;background: #d1dade">Chưa thanh toán</span>';
                            } else {
                                return '<span style="border-radius: 5px;padding: 5px;color: #5e5e5e;background: #d1dade">Đã thanh toán</span>';
                            }
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function($model){
                            if ($model->status == Orders::STATUS_PENDING){
                                return '<span style="border-radius: 5px;padding: 5px;color: #fff;background: #00a65a">Chờ xử lý</span>';
                            }
                            if ($model->status == Orders::STATUS_PROCESSED){
                                return '<span style="border-radius: 5px;padding: 5px;color: #fff;background: #00a65a">Đã xử lý</span>';
                            }
                            if ($model->status == Orders::STATUS_FINISHED){
                                return '<span style="border-radius: 5px;padding: 5px;color: #fff;background: #00a65a">Đã hoàn thành</span>';
                            }
                            if ($model->status == Orders::STATUS_CANCELLED){
                                return '<span style="border-radius: 5px;padding: 5px;color: #fff;background: #00a65a">Đã hủy</span>';
                            }
                        }
                    ],
                    [
                        'attribute' => 'total_price',
                        'format' => 'raw',
                        'value' => function($model){
                            return number_format($model->total_price).' đ';
                        },
                        'enableSorting' => false
                    ],
//            'require_date',
                    // 'ship_date',
                    // 'shiper_id',
                    // 'freight',

                    // 'ship_phone',
                    // 'ship_email:email',
                    // 'ship_address',
                    // 'ship_city',
                    // 'ship_district',
                    // 'ship_ward',
                    // 'ship_postalcode',
                    // 'ship_country',

                    // 'status',
                    // 'note:ntext',
                    // 'payment_type',
                    // 'notification_type',

//            ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>

