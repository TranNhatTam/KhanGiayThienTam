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
<section class="main">
    <div class="main-content">
        <div class="breadcrumb-blk">
            <div class="container">
                <p>Trang chủ / Đơn hàng</p>
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
                                </tr>
                                <?php
                                $totalPrice = 0;
                                /* @var $item \common\models\OrderDetails */
                                if (!empty($orderDetailModel)) {
                                    foreach ($orderDetailModel as $item) {
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="cart-img"><img src="<?= $item->product->fullPathImageThumbnail ?>"
                                                                           alt></div>
                                                <h3 class="cart-name"><?= $item->product->name ?></h3>
                                            </td>
                                            <td class="text-center"><?= ($item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ') ?></td>
                                            <td class="text-center">
                                                <?= $item->quantity ?>
                                            </td>
                                            <td class="text-center"><?= ($item->unit_price != null ? number_format($item->total_price, 0, '', '.') . ' đ' : 'Liên Hệ') ?></td>
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
<!--                                <div class="not-login"><a href="#">Đăng ký tài khoản mua hàng </a><a href="#">Đăng nhập</a></div>-->
                                <div class="buy-wihtout-login">
<!--                                    <p>Mua hàng không cần đăng nhập</p>-->
                                    <form>
                                        <div class="form-group">
                                            <input type="text" placeholder="Họ và tên" value="<?=$model->ship_name?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" placeholder="Số điện thoại" value="<?=$model->ship_phone?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" placeholder="Email" value="<?=$model->ship_email?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                                $district = \common\models\District::find()->where(['name'=>$model->ship_district])->one();
                                                $ward = \common\models\Ward::find()->where(['name'=>$model->ship_ward])->one();
                                                if ($district) {
                                                    $type_dis = '';
                                                    if ($district->type == 'quan') $type_dis = "Quận";
                                                    if ($district->type == 'huyen') $type_dis = "Huyện";
                                                    if ($district->type == 'thanh-pho') $type_dis = "Thành phố";
                                                    $name_dis = $type_dis.' '.$district->name;
                                                } else {
                                                    $name_dis = $model->ship_district;
                                                }
                                                if ($ward) {
                                                    $type_ward = '';
                                                    if ($ward->type == 'phuong') $type_ward = "Phường";
                                                    if ($ward->type == 'xa') $type_ward = "Xã";
                                                    $name_ward = $type_ward.' '.$ward->name;
                                                } else {
                                                    $name_ward = $model->ship_ward;
                                                }
                                            ?>
                                            <input type="text" placeholder="Địa chỉ" value="<?=$model->ship_address.', '.$name_ward.', '.$name_dis.', '.$model->ship_city?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <textarea rows="3" placeholder="Ghi chú" disabled><?=$model->note?></textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart-summary">
                        <div class="cart-sum-inner">
                            <h3 class="text-center">Chi tiết đơn hàng</h3>
                            <div class="cart-total-price">
                                <p><span class="ttl">Tạm tính:</span><span
                                        class="val"><?= number_format($model->total_price, 0, '', '.') . ' đ' ?></span></p>
                                <p><span class="ttl">Phí ship:</span><span class="val">0đ</span></p>
                                <p class="cart-total"><span class="ttl">Tổng cộng:</span><span
                                        class="val"><?= number_format($model->total_price, 0, '', '.') . ' đ' ?></span></p>

                            </div>
                            <div class="payment-type" style="padding-bottom: 0px">
                                <h4><strong>Phương thức thanh toán</strong></h4>
                                <div class="custom-rdo">
                                    <label>
                                        <span>- <?=$model->description?></span>
                                    </label>
                                </div>
                            </div>
                            <div class="note-cart">
                                <p>- Thời gian giao hàng từ 3 - 5 ngày làm việc</p>
                                <p>- Đổi trả hàng trong vòng 90 ngày</p>
                                <p>- Miễn phí giao hàng toàn quốc</p>
                                <p>- Thanh toán khi nhận hàng / Thanh toán online</p>
                            </div>

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
                window.location.reload();
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
                window.location.reload();
            } 
        }
    })
});

JS;
$this->registerJs($js);
?>
