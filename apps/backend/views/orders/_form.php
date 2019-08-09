<?php

use backend\models\OrderDetailsSearch;
use common\models\Orders;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\bootstrap\ActiveForm */
?>

    <div class="orders-form">

        <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3>Chi tiết sản phẩm</h3>
                    </div>
                    <div class="box-body">


                        <?= $this->render('_tableDetailAddProduct') ?>
                        <?php
                        $data = \yii\helpers\ArrayHelper::map(\common\models\Product::find()->all(), 'id', 'name');


                        echo Select2::widget([
                            'name' => 'products',
                            'data' => $data,
                            'options' => ['placeholder' => 'Chọn sản phẩm ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);

                        ?>
                        <p class="margin">Nhập số lượng muốn thêm</p>
                        <div class="input-group" style="width: 250px">
                            <input type="number" id="inputQuantity" class="form-control" placeholder="Nhập số lượng...."
                                   value="1" min="1" max="99">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success text-center add-product"><i
                                            class="fa fa-plus"></i> Thêm sản phẩm
                                </button>
                            </div>

                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-6">
                                <?php echo $form->field($model, 'ship')->textInput()->label('Phí vận chuyển') ?>

                                <?php echo $form->field($model, 'total_price')->textInput(['id' => 'inputTotalPrice']) ?>

                                <?php echo $form->field($model, 'note')->textarea(['rows' => 6]) ?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $form->field($model, 'status')->dropDownList([Orders::STATUS_PENDING => 'Chờ xử lý',Orders::STATUS_PROCESSED => 'Đã xử lý',Orders::STATUS_FINISHED => 'Đã hoàn thành',Orders::STATUS_CANCELLED => 'Đã hủy']) ?>

                                <?php echo $form->field($model, 'payment_status')->dropDownList([0 => 'Chưa thanh toán', 1 => 'Đã thanh toán']) ?>

                                <?php echo $form->field($model, 'ship_status')->dropDownList([0 => 'Chưa giao hàng', 1 => 'Đã giao hàng']) ?>

                                <?php echo $form->field($model, 'description')->dropDownList(['Thanh toán khi giao hàng (COD)' => 'Thanh toán khi giao hàng (COD)', 'Chuyển khoản qua ngân hàng' => 'Chuyển khoản qua ngân hàng'])->label('Phương thức thanh toán') ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3>Thông tin đơn hàng</h3>
                    </div>
                    <div class="box-body">
                        <?php echo $form->field($model, 'ship_name')->textInput(['maxlength' => true]) ?>

                        <?php echo $form->field($model, 'ship_phone')->textInput(['maxlength' => true]) ?>

                        <?php echo $form->field($model, 'ship_email')->textInput(['maxlength' => true]) ?>

                        <?php echo $form->field($model, 'ship_address')->textInput(['maxlength' => true]) ?>

                        <?php echo $form->field($model, 'ship_city')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Province::find()->all(),'id','name'), ['id'=>'cat-id','prompt'=>'Tỉnh/Thành Phố'])?>

                        <?php echo $form->field($model, 'ship_district')->widget(DepDrop::classname(), [
                            'options'=>['id'=>'subcat-id'],
                            'pluginOptions'=>[
                                'depends'=>['cat-id'],
                                'placeholder'=>'Quận/Huyện...',
                                'url'=>Url::to(['/orders/subcat'])
                            ]
                        ]); ?>

                        <?php echo $form->field($model, 'ship_ward')->widget(DepDrop::classname(), [
                            'pluginOptions'=>[
                                'depends'=>['cat-id', 'subcat-id'],
                                'placeholder'=>'Phường/Xã...',
                                'url'=>Url::to(['/orders/prod'])
                            ]
                        ]); ?>

                        <?php echo $form->field($model, 'ship_country')->textInput(['maxlength' => true,'value'=>'Việt Nam','disabled'=> true]) ?>
                    </div>
                </div>
            </div>
        </div>




        <div class="form-group">
            <?php echo Html::submitButton($model->isNewRecord ? 'Tạo' : 'Cập nhập', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<script>
    function RemoveProductCart(idProductCart) {
        console.log(idProductCart);
        $.ajax({
            'url':'/orders/remove-product-cart',
            'method':'POST',
            'data': {
                'id' : idProductCart
            },
            'success': function(data) {
                $("#inputTotalPrice").val(data.totalPrice);
                $.pjax.reload({container:"#pjax-cart-container",pushState:false,timeout:5000});
            }
        })
    }
</script>
<?php
$js = <<< JS
   
        $('.add-product').click(function () {
            $('select[name="products"]').each(function () {
                let id = $('select[name="products"]').val();
                let quantity = $("#inputQuantity").val();
                if(quantity <= 1)
                    {
                        quantity = 1;
                    }
                $.ajax({
                    'url':'/orders/add-product',
                    'method':'POST',
                    'data': {
                        'id' : id,
                        'quantity' : quantity
                    },
                    'success': function(data) {
                        $("#inputTotalPrice").val(data.totalPrice);
                        $.pjax.reload({container:"#pjax-cart-container",pushState:false,timeout:5000});

                    }
                })
            })
        });
        
        
JS;
$this->registerJs($js);