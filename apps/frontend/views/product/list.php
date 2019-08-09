<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/16/2018
 * Time: 4:32 PM
 */
?>
<div class="row">
    <?php
    /* @var $itemProduct \common\models\Product */
    $count = count($product);
    if ($count == 0){
        echo 'Không có sản phẩm nào phù hợp với kết quả tìm kiếm.';
    } else {
        foreach ($product as $itemProduct) {
            if ($itemProduct->urls==null)
                var_dump('ss');
            else
            {
                $route=$itemProduct->urls->route;
            }
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="prod-itm">
                    <div class="i-prod-inner">
                        <div class="i-prod-img">
                            <a href="/<?=$route?>"><img src="<?=$itemProduct->fullPathImageThumbnail?>" alt width="163"></a>
                            <?php
                            if ($itemProduct->discount != null || $itemProduct->discount != '') {
                                $discountItem = $itemProduct->discount / $itemProduct->unit_price * 100;
                                ?>
                                <img class="discount" src="/images/icon-discount.png">
                                <span><?=100 - round($discountItem)?>%</span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="i-prod-desc">
                            <a href="/<?=$route?>"><p class="name"><?= $itemProduct->name ?></p></a>
                            <p class="price">
                                <?php
                                if ($itemProduct->discount != null || $itemProduct->discount != '') {
                                    echo ($itemProduct->discount != null ? number_format($itemProduct->discount, 0, '', '.') : 'Liên Hệ')."đ<del style='color: grey; padding-left: 10px;font-size: 12px'>".($itemProduct->unit_price != null ? number_format($itemProduct->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ')."</del>";
                                } else {
                                    echo ($itemProduct->unit_price != null ? number_format($itemProduct->unit_price, 0, '', '.') : 'Liên Hệ').'đ';
                                }
                                ?>
                            </p>
                            <button class="buy-prod" data-id="<?= $itemProduct->id ?>"
                                    data-name="<?= $itemProduct->name ?>">Mua hàng</button><a href="javascript:;" data-id="<?=$itemProduct->id?>"  class="view-prod"><i class="fa fa-eye"></i></a><a href="#" class="add-wish"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Product item-->
            <?php
        }
    }
    ?>
</div>
<div class="view-more-prod text-center">
    <?php
    echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>
</div>
<?php
$js = <<<JS
$('.buy-prod').click(function() {
    var id = $(this).attr('data-id');
    var quantity = 1;
    var name = $(this).attr('data-name');
  $.ajax({
    'url':'/cart/add-cart',
    'method':'GET',
    'data':{
        'id':id,
        'quantity':quantity
    },
    'success': function(data) {
      if (data.result == 'success') {
          $('.buy-product').html("<i class='fa fa-check-circle' style='font-size:30px;color:#5cb85c'></i> <span style='font-size:20px'>Thêm sản phẩm "+name+" thành công.</span>");
         $('#myModal').modal('show');
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
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

        <!-- Modal content-->
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

