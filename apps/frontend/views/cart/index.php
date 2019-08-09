<?php

/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/18/2018
 * Time: 3:24 PM
 */

use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $products \dtsmart\cart\ItemInterface[] */
$this->title = 'Giỏ hàng';
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-error alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>
<section class="main">
    <div class="main-content">
        <div class="breadcrumb-blk">
            <div class="container">
                <p>Trang chủ / Giỏ hàng</p>
            </div>
        </div>
        <div class="cart-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12 cart-tb">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th class="text-center">Sản phẩm</th>
                                    <th class="text-center">Đơn giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Tổng cộng</th>
                                    <th class="text-center"></th>
                                </tr>
                                <?php
                                $totalPrice = 0;
                                /* @var $item \common\models\Product */
                                if (!empty($products)) {
                                    foreach ($products as $item) {
                                        if ($item->discount != null || $item->discount != '') {
                                            $itemTotalPrice = $item->discount * $item->quantity;
                                        } else {
                                            $itemTotalPrice = $item->unit_price * $item->quantity;
                                        }
                                        $totalPrice = $totalPrice + $itemTotalPrice;
                                        ?>
                                        <tr id="item-<?= $item->id ?>">
                                            <td>
                                                <div class="cart-img"><img src="<?= $item->fullPathImageThumbnail ?>"
                                                                           alt></div>
                                                <h3 class="cart-name"><?= $item->name ?></h3>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($item->discount != null || $item->discount != '') {
                                                    echo($item->discount != null ? number_format($item->discount, 0, '', '.') . ' đ' : 'Liên Hệ');
                                                } else {
                                                    echo($item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ');
                                                }

                                                ?>
                                            </td>
                                            <td id="item-<?= $item->id ?>">
                                                <div class="quantity-blk">
                                                    <input type="text" value="<?= $item->quantity ?>"
                                                           class="quantity-txt">
                                                    <button class="decre" data-id="<?= $item->id ?>"><i
                                                                class="fa fa-minus"></i></button>
                                                    <button class="incre" data-id="<?= $item->id ?>"><i
                                                                class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td class="text-center total-unit-price"><?= ($item->unit_price != null ? number_format($itemTotalPrice, 0, '', '.') . ' đ' : 'Liên Hệ') ?></td>
                                            <td class="text-center">
                                                <a href="/cart/delete?id=<?= $item->id ?>" class="del-btn"><i
                                                            class="fa fa-trash"></i></a></td>
                                        </tr>
                                        <!-- END: Cart itm tr-->
                                        <?php
                                    }
                                }
                                ?>

                            </table>
                        </div>
                    </div>
                    <div class="cart-ship-info">
                        <div class="cart-ship-info-inner">
                            <h3>Thông tin giao hàng</h3>
                            <div class="ship-form">
                                <div class="not-login"><a href="#">Đăng ký tài khoản mua hàng </a><a href="#">Đăng
                                        nhập</a></div>
                                <div class="buy-wihtout-login">
                                    <p>Mua hàng không cần đăng nhập</p>
                                    <?php $form = ActiveForm::begin(['action' => '/cart/checkout', 'enableClientValidation' => true,]); ?>

                                    <?php echo $form->field($model, 'ship_name')->textInput(['placeholder' => 'Họ và tên'])->label(false) ?>

                                    <?php echo $form->field($model, 'ship_phone')->textInput(['placeholder' => 'Số điện thoại'])->label(false) ?>

                                    <?php echo $form->field($model, 'ship_address')->textInput(['placeholder' => 'Địa chỉ'])->label(false) ?>

                                    <?php echo $form->field($model, 'ship_city')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Province::find()->orderBy(['name' => SORT_ASC])->all(), 'name', 'name'), ['id' => 'cat-id', 'prompt' => 'Tỉnh/Thành Phố'])->label(false) ?>

                                    <?php echo $form->field($model, 'ship_district')->widget(DepDrop::classname(), [
                                        'options' => ['id' => 'subcat-id'],
                                        'pluginOptions' => [
                                            'depends' => ['cat-id'],
                                            'placeholder' => 'Quận/Huyện...',
                                            'url' => Url::to(['/cart/subcat']),
                                        ]
                                    ])->label(false); ?>

                                    <?php echo $form->field($model, 'ship_ward')->widget(DepDrop::classname(), [
                                        'pluginOptions' => [
                                            'depends' => ['cat-id', 'subcat-id'],
                                            'placeholder' => 'Phường/Xã...',
                                            'url' => Url::to(['/cart/prod']),
                                        ]
                                    ])->label(false); ?>

                                    <?php echo $form->field($model, 'note')->textarea(['rows' => 4, 'placeholder' => 'Ghi chú'])->label(false) ?>

                                    <?php echo $form->field($model, 'total_price')->hiddenInput(['value' => $totalPrice, 'id' => 'total_price'])->label(false) ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-summary">
                        <div class="cart-sum-inner">
                            <h3 class="text-center">Chi tiết đơn hàng</h3>
                            <div class="cart-total-price">
                                <p><span class="ttl">Tạm tính:</span><span
                                            class="val temporary-price"><?= number_format($totalPrice, 0, '', '.') . ' đ' ?></span>
                                </p>
                                <p><span class="ttl">Phí ship:</span><span class="val">0đ</span></p>
                                <!--                                    <input type="text" placeholder="Nhập mã giảm giá" class="discount-ipt">-->
                                <p class="cart-total"><span class="ttl">Tổng cộng:</span><span
                                            class="val total-price"><?= number_format($totalPrice, 0, '', '.') . ' đ' ?></span>
                                </p>
                            </div>
                        </div>
                        <button type="submit" class="checkout-btn" style="width: 100%">Thanh toán</button>
                        <div class="note-cart">
                            <p>- Thời gian giao hàng từ 3 - 5 ngày làm việc</p>
                            <p>- Đổi trả hàng trong vòng 90 ngày</p>
                            <p>- Miễn phí giao hàng toàn quốc</p>
                            <p>- Thanh toán khi nhận hàng / Thanh toán online</p>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php
$token = Yii::$app->request->getCsrfToken();
$js = <<<JS
$('.incre').click(function() {
    var id  = $(this).attr('data-id');
    var quantity = $(this).parent().find('input').val();
    quantity = +quantity + 1;
    $.ajax({
        'url':'/cart/update-cart-item-quantity',
        'method':'POST',
        'data':{
            'id':id,
            'quantity':quantity,
            '_csrf': '$token',
        },
        'success': function(data) {
            if (data.result == 'success') {
                $('tr#item-'+id).find('.total-unit-price').html(data.total_unit_price);
                $('tr#item-'+id).find('.quantity-txt').val(quantity);
                $('.temporary-price').html(data.total_price);
                $('.total-price').html(data.total_price);
                $('#total_price').val(data.total);
            } 
        }
    })
});
$('.decre').click(function() {
    var id  = $(this).attr('data-id');
    var quantity = $(this).parent().find('input').val();
    quantity = +quantity - 1;
    $.ajax({
        'url':'/cart/update-cart-item-quantity',
        'method':'POST',
        'data':{
            'id':id,
            'quantity':quantity,
            '_csrf': '$token',
        },
        'success': function(data) {
            if (data.result == 'success') {
                $('tr#item-'+id).find('.total-unit-price').html(data.total_unit_price);
                $('tr#item-'+id).find('.quantity-txt').val(quantity);
                $('.temporary-price').html(data.total_price);
                $('.total-price').html(data.total_price);
                $('#total_price').val(data.total);
            } 
        }
    })
});

JS;
$this->registerJs($js);
?>
