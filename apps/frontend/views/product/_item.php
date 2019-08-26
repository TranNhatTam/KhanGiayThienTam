<?php
/* @var $product array|\common\models\Product[]|\yii\db\ActiveRecord[] */
?>
<?php if ($product == null) { ?>
    echo 'Không có sản phẩm nào phù hợp với kết quả tìm kiếm.';
<?php } else {
    foreach ($product as $item) { ?>
        <div class="product sf-dress clearfix">
            <div class="product-image">
                <a href="#"><img src="<?= $item->getThumbnail() ?>" alt="<?= $item->code ?>"></a>
                <?php if ($item->discount != null || $item->discount != 0) { ?>
                    <div class="sale-flash"><?= $item->discount ?></div>
                <?php } ?>
                <div class="product-overlay">
                    <button class="add-to-cart" data-id="<?= $item->id ?>"
                            data-name="<?= $item->name ?>"><i class="icon-shopping-cart"></i><span> Đặt Hàng</span>
                    </button>
                    <button class="item-quick-view" data-lightbox="ajax"><i
                                class="icon-zoom-in2"></i><span> Xem Nhanh</span></button>
                </div>
            </div>
            <div class="product-desc center">
                <div class="product-title"><h3><a href="#"><?= $item->name ?></a></h3></div>
                <div class="product-price">
                    <?php if ($item->discount != null || $item->discount != 0) { ?>
                        <?php if ($item->discount != null || $item->discount != 0) { ?>
                            <del><?= $item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ' ?></del>
                            <ins><?= $item->discount != null ? number_format($item->discount, 0, '', '.') . ' đ' : 'Liên Hệ' ?></ins>
                        <?php } ?>
                    <?php } else { ?>
                        <ins><?= $item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ' ?></ins>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php }
} ?>
<?php
$js = <<<JS
$('.add-to-cart').click(function() {
    var id = $(this).attr('data-id');
    var quantity = 1;
    var name = $(this).attr('data-name');
    $.ajax({
        'url':'/cart/add-cart',
        'method':'GET',
        'data':{
            'id': id,
            'quantity': quantity
        },
        'success': function(data) {
          if (data.result === 'success') {
                $('.buy-product').html("<i class='fa fa-check-circle' style='font-size:30px;color:#5cb85c'></i> <span style='font-size:20px'>Thêm sản phẩm "+name+" thành công.</span>");
                $('#addToCartModal').modal('show');
                $.pjax.reload({container:"#header-cart-pjax",'timeout':5000});
          } 
        }
    });
});
$('.view-prod').click(function() {
  var id = $(this).attr('data-id');
  $.ajax({
    'url':'/product/quick-view',
    'method':'GET',
    'data': {
        'id':id,
    },
    'success':function(data) {
      $('.quick-view').html(data.result);
      $('#quickViewModal').modal('show');
    }
  })
})
JS;
$this->registerJs($js);
?>
<div class="modal fade" id="addToCartModal" role="dialog">
    <div class="modal-dialog" id="addToCartModal">
        <div class="modal-content">
            <div class="modal-body buy-product text-center">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pull-left" data-dismiss="modal">Tiếp tục mua hàng</button>
                <a href="/cart/index" class="btn btn-default">Đơn hàng</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="quickViewModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                <h4 class="modal-title text-center"></h4>
            </div>
            <div class="modal-body text-center">
                <div class="quick-view">
                </div>
            </div>
        </div>
    </div>
</div>
