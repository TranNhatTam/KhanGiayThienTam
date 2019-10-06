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
            <div class="table-responsive">
                <table class="table cart">
                    <thead>
                    <tr>
                        <th class="cart-product-remove">&nbsp;</th>
                        <th class="cart-product-name">Sản Phẩm</th>
                        <th class="cart-product-price">Đơn Giá</th>
                        <th class="cart-product-quantity">Số Lượng</th>
                        <th class="cart-product-subtotal">Tổng Cộng</th>
                        <th class="cart-product-thumbnail">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    use yii\widgets\ActiveForm;

                    $totalPrice = 0;
                    /* @var $item \common\models\Product */
                    if (!empty($products)) {
                        foreach ($products as $item) {
                            if ($item->discount != null || $item->discount != 0) {
                                $itemTotalPrice = $item->discount * $item->quantity;
                            } else {
                                $itemTotalPrice = $item->unit_price * $item->quantity;
                            }
                            $totalPrice += $itemTotalPrice;
                            ?>
                            <tr class="cart_item" id="item-<?= $item->id ?>">
                                <td class="cart-product-thumbnail">
                                    <a href="/<?= $item->url->route ?>"><img width="64" height="64"
                                                                             src="<?= $item->getThumbnail() ?>"
                                                                             alt="<?= $item->name ?>"></a>
                                </td>
                                <td class="cart-product-name">
                                    <a href="/<?= $item->url->route ?>"><?= $item->name ?></a>
                                </td>
                                <td class="cart-product-price">
                                    <?php if ($item->discount != null || $item->discount != 0) { ?>
                                        <span class="amount"><?= number_format($item->discount, 0, '', '.') . ' đ' ?></span>
                                    <?php } else { ?>
                                        <span class="amount"><?= number_format($item->unit_price, 0, '', '.') . ' đ' ?></span>
                                    <?php } ?>
                                </td>
                                <td class="cart-product-quantity">
                                    <div class="quantity clearfix">
                                        <input type="button" value="-" class="minus" data-id="<?= $item->id ?>">
                                        <input type="text" name="quantity" value="<?= $item->quantity ?>" class="qty"/>
                                        <input type="button" value="+" class="plus" data-id="<?= $item->id ?>">
                                    </div>
                                </td>
                                <td class="cart-product-subtotal">
                                    <span class="amount"><?= number_format($itemTotalPrice, 0, '', '.') . ' đ' ?></span>
                                </td>
                                <td class="cart-product-remove">
                                    <a href="/cart/delete?id=<?= $item->id ?>" class="remove" title="Remove this item"><i class="icon-trash2"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    } ?>
                    </tbody>
                </table>
            </div>

            <div class="row clearfix">
                <div class="col-lg-6 clearfix">
                    <h4>Thông Tin Giao Hàng</h4>
                    <div class="ship-form">
                        <?php $form = ActiveForm::begin(['action' => '/cart/checkout', 'enableClientValidation' => true,]); ?>

                        <?php echo $form->field($model, 'ship_name')->textInput(['placeholder' => 'Họ và tên'])->label(false) ?>

                        <?php echo $form->field($model, 'ship_phone')->textInput(['placeholder' => 'Số điện thoại'])->label(false) ?>

                        <?php echo $form->field($model, 'ship_address')->textInput(['placeholder' => 'Địa chỉ'])->label(false) ?>

                        <?php echo $form->field($model, 'note')->textarea(['rows' => 4, 'placeholder' => 'Ghi chú'])->label(false) ?>

                        <?php echo $form->field($model, 'total_price')->hiddenInput(['value' => $totalPrice, 'id' => 'total_price'])->label(false) ?>
                    </div>
                </div>
                <div class="col-lg-6 clearfix">
                    <h4>Chi Tiết Đơn Hàng</h4>
                    <div class="table-responsive">
                        <table class="table cart">
                            <tbody>
                            <tr class="cart_item">
                                <td class="cart-product-name">
                                    <strong>Tạm Tính: </strong>
                                </td>
                                <td class="cart-product-name">
                                    <span class="amount temporary-price"><?= number_format($totalPrice, 0, '', '.') . ' đ' ?></span>
                                </td>
                            </tr>
                            <tr class="cart_item">
                                <td class="cart-product-name">
                                    <strong>Phí Ship: </strong>
                                </td>

                                <td class="cart-product-name">
                                    <span class="amount ">0 đ</span>
                                </td>
                            </tr>
                            <tr class="cart_item">
                                <td class="cart-product-name">
                                    <strong>Tổng Cộng</strong>
                                </td>

                                <td class="cart-product-name">
                                    <span class="amount color lead total-price"><strong><?= number_format($totalPrice, 0, '', '.') . ' đ' ?></strong></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="button button-3d notopmargin fright" style="width: 100%">Hoàn Thành
                    </button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section><!-- #content end -->
<?php
$token = Yii::$app->request->getCsrfToken();
$js = <<<JS
$('.plus').click(function() {
    var id  = $(this).attr('data-id');
    var quantity = $(this).parent().find('input.qty').val();
    $.ajax({
        'url':'/cart/update-cart-item-quantity',
        'method':'POST',
        'data':{
            'id': id,
            'quantity': quantity,
            '_csrf': '$token',
        },
        'success': function(data) {
            if (data.result === 'success') {
                $('tr#item-'+id).find('.cart-product-subtotal .amount').html(data.total_unit_price);
                $('tr#item-'+id).find('.cart-product-quantity .quantity .qty').val(quantity);
                $('.temporary-price').html(data.total_price);
                $('.total-price').html(data.total_price);
                $('#total_price').val(data.total);
            } 
        }
    })
});
$('.minus').click(function() {
    var id  = $(this).attr('data-id');
    var quantity = $(this).parent().find('input.qty').val();
    $.ajax({
        'url':'/cart/update-cart-item-quantity',
        'method':'POST',
        'data':{
            'id':id,
            'quantity':quantity,
            '_csrf': '$token',
        },
        'success': function(data) {
           if (data.result === 'success') {
                $('tr#item-'+id).find('.cart-product-subtotal .amount').html(data.total_unit_price + ' ');
                $('tr#item-'+id).find('.cart-product-quantity .quantity .qty').val(quantity);
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