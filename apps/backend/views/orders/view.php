<?php

use common\models\Order;
use common\models\OrderDetail;
use common\models\Orders;
use common\models\OrdersDetail;
use common\models\Product;
use kartik\depdrop\DepDrop;
use kartik\editable\Editable;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $searchModel backend\models\search\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">
    <?php echo Html::a('Xóa đơn hàng', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'style' => 'margin-bottom: 10px',
        'data' => [
            'confirm' => 'Bạn có muốn xóa đơn hàng này?',
            'method' => 'post',
        ],
    ]) ?>
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <h2>Chi tiết đơn hàng</h2>
                </div>
                <div class="box-body" style="padding: 0px 30px 20px 30px">
                    <div>
                        <label>Mã đơn hàng:</label>
                        <span>#<?= $model->id ?></span>
                    </div>
                    <div>
                        <label>Ngày tạo:</label>
                        <span><?= date('d/m/Y H:i', strtotime($model->order_date)) ?></span>
                    </div>
                    <div class="product-detail" style="padding: 10px;">
                        <?php echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'summary' => false,
                            'columns' => [
//                                ['class' => 'yii\grid\SerialColumn'],

//                                'id',
//                                'order_id',
                                'product.code',
                                'product.name',
//                                'product_image',
                                // 'product_ref',

                                [
                                    'attribute' => 'quantity',
                                    'enableSorting' => false
                                ],
//                                'unit_price',
                                // 'tax_value',
                                // 'discount',
                                // 'weight',
                                // 'category_id',
                                // 'extra_number',
                                // 'extra_percent',
                                // 'extra_lbs',
                                [
                                    'attribute' => 'total_price',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return number_format($model->total_price) . ' đ';
                                    },
                                    'enableSorting' => false
                                ],

                                // 'note:ntext',
                                // 'tracking_status',
                                // 'order_date',
                                // 'status',
                                // 'created_at',
                                // 'updated_at',

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{delete}',
                                    'buttons' => [
                                        'delete' => function ($url, $model) {
                                            return Html::a(
                                                '<span class="fa fa-minus-circle" style="color: red"></span>',
                                                ['/orders/delete-orders-detail', 'id' => $model->id],
                                                [
                                                    'title' => 'Remove',
                                                ]
                                            );
                                        },
                                    ],
                                ],
                            ],
                        ]); ?>
                    </div>
                    <button class="btn btn-success add-product-btn">Thêm sản phẩm</button>
                    <div class="add-more-product" style="display: none">
                        <?php
                        $form = ActiveForm::begin([
                            'action' => '/orders/update-add-product?id=' . $model->id,
                            'method' => 'POST'
                        ]);
                        echo Select2::widget([
                            'name' => 'products',
                            'data' => Product::getArrayProduct(),
                            'options' => ['placeholder' => 'Chọn sản phẩm ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                        <div class="input-group" style="width: 250px">
                            <input type="number" id="inputQuantity" class="form-control" name="quantity"
                                   placeholder="Nhập số lượng...."
                                   value="1" min="1" max="99" style="margin-top: 10px">
                            <div class="input-group-btn">
                                <?php echo Html::submitButton('<i
                                            class="fa fa-plus"></i> Thêm', ['class' => 'btn btn-success', 'style' => 'margin-top: 10px']); ?>
                            </div>

                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php $form = ActiveForm::begin([
                                'action' => '/orders/update-note?id=' . $model->id,
                                'method' => 'POST'
                            ]); ?>

                            <?php echo $form->field($model, 'note')->textarea(['rows' => 4]) ?>

                            <div class="form-group">
                                <?php echo Html::submitButton('Lưu', ['class' => 'btn btn-success']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <?php
                                    $orderDetail = OrdersDetail::find()->where(['order_id' => $model->id])->all();
                                    $totalPrice = 0;
                                    $totalDiscount = 0;
                                    $totalTax = 0;
                                    foreach ($orderDetail as $item) {
                                        $totalPrice = $totalPrice + $item->total_price;
                                        $totalDiscount = $totalDiscount + $item->discount;
                                    }
                                    $finalPrice = $totalPrice - $totalDiscount;
                                    ?>
                                    <td class="text-right no-border">Tổng giá trị sản phẩm</td>
                                    <td class="text-right no-border"><?= number_format($totalPrice) . ' đ' ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right no-border">Khuyến mãi</td>
                                    <td class="text-right no-border"><?= number_format($totalDiscount) . ' đ' ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right no-border">Vận chuyển</td>
                                    <td class="text-right no-border"><?= number_format($totalTax) . ' đ' ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right no-border"><strong>Số tiền phải thanh
                                            toán</strong><br><?= $model->payment_type ?></td>
                                    <td class="text-right no-border">
                                        <strong><?= number_format($finalPrice) . ' đ' ?></strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-body">
                    <div style="padding: 0px 20px 20px 20px;">
                        <h4>Thông tin đơn hàng</h4>
                        <label>Email</label><br>
                        <input class="form-control" value="<?= $model->ship_email ?>" required disabled>
                    </div>
                    <div style="border-top: solid 1px lightgrey;padding: 10px 20px 20px 20px">
                        <div>
                            <h4 class="pull-left">Địa chỉ giao hàng</h4>
                            <a href="javascript:;" class="text-center pull-right" data-toggle="modal"
                               data-target="#myModal" style="padding-top: 10px;padding-right: 20px;font-size: 18px"><i
                                        class="fa fa-pencil"></i></a>
                        </div>

                        <table class="table">
                            <tr>
                                <td><strong>Tên người nhận</strong></td>
                                <td><?= $model->ship_name ?></td>
                            </tr>
                            <tr>
                                <td><strong>Số điện thoại người nhận</strong></td>
                                <td><?= $model->ship_phone ?></td>
                            </tr>
                            <tr>
                                <td><strong>Địa chỉ nhận</strong></td>
                                <td><?= $model->ship_address . ', ' . $model->ship_ward . ', ' . $model->ship_district . ', ' . $model->ship_city ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-body">
                    <div style="padding: 0px 20px 20px 20px;">
                        <h4>Trạng thái đơn hàng</h4>
                        <table class="table">
                            <tr>
                                <td><strong>Giao hàng</strong></td>
                                <td>
                                    <?php
                                    echo Editable::widget([
                                        'model' => $model,
                                        'attribute' => 'ship_status',
                                        'value' => 0,
                                        'asPopover' => false,
                                        'header' => 'Status',
                                        'format' => Editable::FORMAT_BUTTON,
                                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                                        'data' => Orders::shipStatuses(),
                                        'options' => ['class' => 'form-control', 'prompt' => 'Chọn trạng thái...'],
                                        'displayValueConfig' => Orders::shipStatuses(),
                                        'formOptions' => [
                                            'action' => '/orders/edit-ship-status?id=' . $model->id,
                                        ],
                                    ]);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Thanh toán</strong></td>
                                <td>
                                    <?php
                                    echo Editable::widget([
                                        'model' => $model,
                                        'attribute' => 'payment_status',
                                        'value' => 0,
                                        'asPopover' => false,
                                        'header' => 'Status',
                                        'format' => Editable::FORMAT_BUTTON,
                                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                                        'data' => Orders::paymentStatues(),
                                        'options' => ['class' => 'form-control', 'prompt' => 'Chọn trạng thái...'],
                                        'displayValueConfig' => Orders::paymentStatues(),
                                        'formOptions' => [
                                            'action' => '/orders/edit-payment-status?id=' . $model->id,
                                        ],
                                    ]);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Trạng thái</strong></td>
                                <td>
                                    <?php
                                    echo Editable::widget([
                                        'model' => $model,
                                        'attribute' => 'status',
                                        'value' => 0,
                                        'asPopover' => false,
                                        'header' => 'Status',
                                        'format' => Editable::FORMAT_BUTTON,
                                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                                        'data' => Orders::statuses(),
                                        'options' => ['class' => 'form-control', 'prompt' => 'Chọn trạng thái...'],
                                        'displayValueConfig' => Orders::statuses(),
                                        'formOptions' => [
                                            'action' => '/orders/edit-status?id=' . $model->id,
                                        ],
                                    ]);
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                <h4 class="modal-title"><strong>Cập nhập địa chỉ</strong></h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'action' => '/orders/update-ship-address?id=' . $model->id,
                    'method' => 'POST'
                ]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'ship_name')->textInput(['placeholder' => 'Tên khách hàng'])->label('Tên khách hàng') ?>
                        <?php echo $form->field($model, 'ship_phone')->textInput(['placeholder' => 'Số điện thoại']) ?>
                        <?php echo $form->field($model, 'ship_district')->widget(DepDrop::classname(), [
                            'options' => ['id' => 'subcat-id'],
                            'pluginOptions' => [
                                'depends' => ['cat-id'],
                                'placeholder' => 'Quận/Huyện...',
                                'url' => Url::to(['/orders/subcat'])
                            ]
                        ]); ?>
                        <?php echo $form->field($model, 'ship_country')->textInput(['placeholder' => 'Quốc gia', 'disabled' => true]) ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'ship_email')->textInput(['placeholder' => 'Email']) ?>
                        <?php echo $form->field($model, 'ship_address')->textInput(['placeholder' => 'Địa chỉ']) ?>
                        <?php //echo $form->field($model, 'ship_city')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Province::find()->all(), 'id', 'name'), ['id' => 'cat-id', 'prompt' => 'Tỉnh/Thành Phố']) ?>
                        <?php //echo $form->field($model, 'ship_ward')->widget(DepDrop::classname(), [
                        //                            'pluginOptions' => [
                        //                                'depends' => ['cat-id', 'subcat-id'],
                        //                                'placeholder' => 'Phường/Xã...',
                        //                                'url' => Url::to(['/orders/prod'])
                        //                            ]
                        //                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <?php echo Html::submitButton('Lưu', ['class' => 'btn btn-danger']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php
$js = <<<JS
 $('.add-product-btn').click(function () {
        $('.add-more-product').show();
        $(this).hide();
    })
JS;
$this->registerJs($js)
?>
