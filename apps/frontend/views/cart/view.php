<?php
/* @var $orderDetailModel OrdersDetail[] */

/* @var $model Orders */

use common\models\Orders;
use common\models\OrdersDetail;
use common\models\Product;

?>
<!-- Page Title
    ============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1>Giỏ Hàng</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang Chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ Hàng</li>
        </ol>
    </div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-lg-6">
                    <h4>Đơn Hàng Của Bạn</h4>
                    <div class="table-responsive">
                        <table class="table cart">
                            <thead>
                            <tr>
                                <th class="cart-product-thumbnail">&nbsp;</th>
                                <th class="cart-product-name">Sản Phẩm</th>
                                <th class="cart-product-quantity">Số Lượng</th>
                                <th class="cart-product-subtotal">Tổng Cộng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $totalPrice = 0;
                            /* @var $item OrdersDetail */
                            foreach ($orderDetailModel as $item) {
                                $product = Product::findOne($item->product_id);
                                ?>
                                <tr class="cart_item" id="item-<?= $item->id ?>">
                                    <td class="cart-product-thumbnail">
                                        <a href="/<?= $product->url->route ?>"><img width="64" height="64"
                                                                                    src="<?= $product->getThumbnail() ?>"
                                                                                    alt="<?= $product->name ?>"></a>
                                    </td>
                                    <td class="cart-product-name">
                                        <a href="/<?= $product->url->route ?>"><?= $product->name ?></a>
                                    </td>

                                    <td class="cart-product-quantity">
                                        <div class="quantity clearfix">
                                            <?= $item->quantity ?>
                                        </div>
                                    </td>
                                    <td class="cart-product-subtotal">
                                        <span class="amount"><?= number_format($item->total_price, 0, '', '.') . ' đ' ?></span>
                                    </td>
                                </tr>
                                <?php
                            } ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h4>Tổng Đơn</h4>
                    <div class="table-responsive">
                        <table class="table cart">
                            <tbody>
                            <tr class="cart_item">
                                <td class="notopborder cart-product-name">
                                    <strong>Tạm Tính</strong>
                                </td>

                                <td class="notopborder cart-product-name">
                                    <span class="amount"><?= number_format($model->total_price, 0, '', '.') . ' đ' ?></span>
                                </td>
                            </tr>
                            <tr class="cart_item">
                                <td class="cart-product-name">
                                    <strong>Phí Ship</strong>
                                </td>

                                <td class="cart-product-name">
                                    <span class="amount">0 đ</span>
                                </td>
                            </tr>
                            <tr class="cart_item">
                                <td class="cart-product-name">
                                    <strong>Tổng Cộng</strong>
                                </td>

                                <td class="cart-product-name">
                                    <span class="amount color lead"><strong><?= number_format($model->total_price, 0, '', '.') . ' đ' ?></strong></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4>Thông Tin Đặt Hàng</h4>
                    <div class="col_half">
                        <label for="shipping-form-name">Họ Và Tên:</label>
                        <input type="text" id="shipping-form-name" name="shipping-form-name"
                               value="<?= $model->ship_name ?>" readonly
                               class="sm-form-control"/>
                    </div>
                    <div class="col_half col_last">
                        <label for="shipping-form-address">Địa Chỉ:</label>
                        <input type="text" id="shipping-form-address" name="shipping-form-address"
                               value="<?= $model->ship_address ?>" readonly
                               class="sm-form-control"/>
                    </div>
                    <div class="col_full">
                        <label for="shipping-form-tel">Điện Thoại:</label>
                        <input type="text" id="shipping-form-tel" name="shipping-form-tel"
                               value="<?= $model->ship_phone ?>" readonly
                               class="sm-form-control"/>
                    </div>
                    <div class="col_full">
                        <label for="shipping-form-note">Ghi Chú:</label>
                        <textarea class="sm-form-control" id="shipping-form-message" name="shipping-form-message" readonly rows="6" cols="30"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- #content end -->