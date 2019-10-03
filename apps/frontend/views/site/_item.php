<?php
/* @var $item Product */

use common\models\Product;

$route = $item->url->route;
?>
<div class="product clearfix">
    <div class="product-image">
        <a href="/<?= $route ?>"><img src="<?= $item->getThumbnail() ?>"
                                      alt="<?= $item->code ?>"></a>
        <?php if ($item->discount != null || $item->discount != 0) { ?>
            <div class="sale-flash"> Sale!</div>
        <?php } ?>
        <div class="product-overlay">
            <div class="product-overlay">
                <button class="add-to-cart" data-id="<?= $item->id ?>"><i
                            class="icon-shopping-cart"></i><span> Đặt Hàng</span></button>
                <button class="item-quick-view" data-id="<?= $item->id ?>"><i
                            class="icon-zoom-in2"></i><span> Xem Nhanh</span></button>
            </div>
        </div>
    </div>
    <div class="product-desc">
        <div class="product-title"><h3><a href="/<?= $route ?>"><?= $item->name ?></a></h3></div>
        <div class="product-price">
            <?php if ($item->discount != null || $item->discount != 0) { ?>
                <del><?= $item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ' ?></del>
                <ins><?= $item->discount != null ? number_format($item->discount, 0, '', '.') . ' đ' : 'Liên Hệ' ?></ins>
            <?php } else { ?>
                <ins><?= $item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ' ?></ins>
            <?php } ?>
        </div>
    </div>
    <div class="modal fade" id="add-cart-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Đặt Hàng</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-line2-close"></i></button>
                </div>
                <div class="modal-body">
                    <h3 class="center" style="padding-top: 30px;">Thêm sản phẩm thành công</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn pull-left" data-dismiss="modal">Tiếp tục mua hàng</button>
                    <a href="/cart/index" class="btn pull-right">Đơn hàng</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="quick-view-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Xem Nhanh</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-line2-close"></i></button>
                </div>
                <div class="modal-body text-center">
                    <div class="quick-view">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$js = <<<JS
$(document).ready(function ($) {
    $('.add-to-cart').click(function() {
        var id = $(this).attr('data-id');
        var quantity = 1;
        $.ajax({
            'url':'/cart/add-cart',
            'method':'GET',
            'data':{
                'id': id,
                'quantity': quantity
            },
            'success': function(data) {
                if (data.result === true) {
                    $('#add-cart-modal').modal('show');
                    $.pjax.reload({container:"#top-cart",'timeout':5000});
                } 
            }
        });
    });
    
    $('.item-quick-view').click(function() {
        var id = $(this).attr('data-id');
        $.ajax({
            'url':'/product/quick-view',
            'method':'GET',
            'data': {
                'id': id,
            },
            'success':function(data) {
                $('.quick-view').html(data.result);
                $('#quick-view-modal').modal('show');
            }
        });
    });
    
});
JS;
$this->registerJs($js)
?>


