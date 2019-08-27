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

<div class="modal fade" id="addToCartModal" role="dialog">
    <div class="modal-dialog" id="addToCartModal">
        <div class="modal-content">
            <div class="modal-body buy-product text-center">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pull-left" data-dismiss="modal">Tiếp tục mua hàng</button>
                <a href="/cart/index" class="btn pull-right btn-default">Đơn hàng</a>
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
<div class="modal1 mfp-hide" id="myModal1">
    <div class="block divcenter" style="background-color: #FFF; max-width: 500px;">
        <div class="center" style="padding: 50px;">
            <h3>A Simple Example of a Text Modal</h3>
            <p class="nobottommargin">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum delectus, tenetur obcaecati porro! Expedita nostrum tempora quia provident perspiciatis inventore, autem eaque, quod explicabo, ipsum, facilis aliquid! Sapiente, possimus quo!</p>
        </div>
        <div class="section center nomargin" style="padding: 30px;">
            <a href="#" class="button" onClick="$.magnificPopup.close();return false;">Close this Modal</a>
        </div>
    </div>
</div>
<?php
$js = <<<JS
$( document ).ready(function() {
  $('.add-to-cart').click(function() {
    $('#myModal1').modal('show');
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
});

JS;
$this->registerJs($js);
?>