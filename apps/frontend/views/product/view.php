<?php /** @var \common\models\Product $product */
use yii\helpers\Inflector;
$this->title = $product->name .' - Nguyên An';
if ($product): ?>
    <section class="main">
        <div class="main-content">
            <div class="breadcrumb-blk">
                <div class="container">
                    <p>Trang chủ / <?php echo $product->name ?></p>
                </div>
            </div>
            <div class="container">
                <div class="prod-detail-head">
                    <div class="row">
                        <div class="col-md-5 col-xs-12">
                            <div class="prod-dt-head-img text-center"><img
                                        src="<?php echo $product->fullPathImageThumbnail ?>" class="xzoom" xoriginal="<?php echo $product->fullPathImageThumbnail ?>" style="width: 50%" alt>
                            </div>
                        </div>
                        <div class="col-md-7 col-xs-12">
                            <div class="prod-dt-head-content">
                                <div class="prod-head-ttl">
                                    <h1><?php echo $product->name ?></h1>
                                </div>
                                <div class="price">
                                    <p>
                                        <?php
                                        if ($product->discount != null || $product->discount != '') {
                                            echo ($product->discount != null ? number_format($product->discount, 0, '', '.') : 'Liên Hệ')."đ<del style='color: grey; padding-left: 10px;font-size: 18px'>".($product->unit_price != null ? number_format($product->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ')."</del>";
                                        } else {
                                            echo ($product->unit_price != null ? number_format($product->unit_price, 0, '', '.') : 'Liên Hệ')."đ";
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="quantity"><span>Số lượng</span>
                                    <div class="quantity-ipt">
                                        <input type="text" value="1" readonly class="quantity-txt">
                                        <button class="increase"><i class="fa fa-plus"></i></button>
                                        <button class="decrease"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="prod-dt-btn">
                                    <a href="javascript:;" data-id="<?= $product->id ?>" data-name="<?=$product->name?>" style="background-image: url('images/icons/cart.png')"
                                       class="add-cart-btn"><span>Thêm vào giỏ</span></a>
                                    <a href="/cart/add-to-cart?id=<?=$product->id?>" style="background-image: url('images/icons/tick.png')" class="buy"><span>Mua hàng</span></a>
                                </div>
                                <div class="prod-promo">
                                    <h3><strong>Quý khách vui lòng đặt hàng qua số
                                            hotline </strong><span>091 533 87 47</span></h3>
                                    <p class="promo-itm"><span>Giảm 100.000 cho đơn hàng đầu trên 3 triệu</span></p>
                                    <p class="promo-itm"><span>Giao nội thành HCM và các chành xe ở HCM</span></p>
                                    <p class="promo-itm"><span>Đặt hàng tại website để được tư vấn hỗ trợ 24/7</span>
                                    </p>
                                </div>
                                <?php if ($productTag): ?>
                                    <div class="tag-list"><strong>Tags: </strong>
                                        <?php foreach ($productTag as $item):
                                            /**@var common\models\ProductTag $item */
                                            ?>
                                            <a href="/<?=Inflector::slug($item->tag_name)?>" class="tag-itm"><span><?php echo $item->tag_name ?></span></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="prod-viewed">
                            <div class="prod-viewed-ttl">
                                <h3>Sản phẩm vừa xem</h3>
                            </div>
                            <div class="prod-viewed-list">
                                <?php
                                $recentlyViewContainer = Yii::$app->recentlyProdView;
                                $productRecentlyList = array_reverse($recentlyViewContainer->getItems());
                                array_shift($productRecentlyList);
                                /**@var common\models\Product $item */
                                foreach ($productRecentlyList as $item):
                                    if ($item->urls == null)
                                        continue;
                                    else
                                        $route = $item->urls->route;
                                    ?>
                                    <div class="prod-itm">
                                        <div class="i-prod-inner">
                                            <div class="i-prod-img"><a href="<?php echo $route ?>"><img
                                                            src="<?php echo $item->fullPathImageThumbnail ?>" alt></a>
                                            </div>
                                            <div class="i-prod-desc">
                                                <a href="<?php echo $route ?>"><p
                                                            class="name"><?php echo $item->name ?></p></a>
                                                <p class="price">
                                                    <?php
                                                    if ($item->discount != null || $item->discount != '') {
                                                        echo ($item->discount != null ? number_format($item->discount, 0, '', '.') : 'Liên Hệ')."đ<del style='color: grey; padding-left: 10px;font-size: 12px'>".($item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ')."</del>";
                                                    } else {
                                                        echo ($item->unit_price != null ? number_format($item->unit_price, 0, '', '.') : 'Liên Hệ');
                                                    }
                                                    ?>
                                                </p>
                                                <button class="buy-prod">Mua hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Product item-->
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!-- END: Product viewed-->
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <div class="prod-dt-desc">
                            <div class="prod-desc-nav">
                                <ul>
                                    <li><a href="#" class="desc-nav-itm active"><span>Mô tả sản phẩm</span></a></li>
                                    <li><a href="#" class="desc-nav-itm"><span>Bình luận</span></a></li>
                                    <li><a href="#" class="desc-nav-itm"><span>Sản phẩm cùng nhóm</span></a></li>
                                </ul>
                            </div>
                            <div class="prod-desc-ct">
                                <?php echo $product->description ?>
                            </div>
                            <div class="prod-cmt"></div>
                            <?php if ($product_df): ?>
                                <div class="prod-related">
                                    <div class="prod-viewed-ttl">
                                        <h3>Sản phẩm cùng nhóm</h3>
                                    </div>
                                    <div class="prod-related-slider">
                                        <?php foreach ($product_df as $item):
                                            if ($item->urls == null)
                                                continue;
                                            else
                                                $route = $item->urls->route;
                                            ?>
                                            <div class="prod-itm">
                                                <div class="i-prod-inner">
                                                    <div class="i-prod-img"><a href="<?php echo $route ?>"><img
                                                                    src="<?php echo $item->fullPathImageThumbnail ?>"
                                                                    style="width: 70%" alt></a></div>
                                                    <div class="i-prod-desc">
                                                        <a href="<?php echo $route ?>"><p
                                                                    class="name"><?php echo $item->name ?></p></a>
                                                        <p class="price">
                                                            <?php
                                                            if ($item->discount != null || $item->discount != '') {
                                                                echo ($item->discount != null ? number_format($item->discount, 0, '', '.') : 'Liên Hệ')."đ<del style='color: grey; padding-left: 10px;font-size: 12px'>".($item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ')."</del>";
                                                            } else {
                                                                echo ($item->unit_price != null ? number_format($item->unit_price, 0, '', '.') : 'Liên Hệ');
                                                            }
                                                            ?>
                                                        </p>
                                                        <button class="buy-prod">Mua hàng</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END: Index product item-->
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php
$js = <<<JS
$('.increase').click(function() {
  var value = $('.quantity-txt').val();
  value = +value + 1;
  $('.quantity-txt').val(value);
  $('a.buy').attr('href','/cart/add-to-cart?id=$product->id&quantity='+$('.quantity-txt').val());
});
$('.decrease').click(function() {
  var value = $('.quantity-txt').val();
  if (value > 1) {
      value = +value - 1;
  $('.quantity-txt').val(value);
  $('a.buy').attr('href','/cart/add-to-cart?id=$product->id&quantity='+$('.quantity-txt').val());
  } 
});
$('.add-cart-btn').click(function() {
  var id = $(this).attr('data-id');
  var quantity = $('.quantity-txt').val();
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
           $('.modal-body').html("<i class='fa fa-check-circle' style='font-size:30px;color:#5cb85c'></i> <span style='font-size:20px'>Thêm sản phẩm "+name+" thành công.</span>");
           $('#myModal').modal('show');
           $.pjax.reload({container:"#header-cart-pjax",'timeout':5000});
      } 
    }
  })
});
$(document).ready(function() {
  $(".xzoom").xzoom();
});
JS;
$this->registerJs($js);
?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn pull-left" data-dismiss="modal">Tiếp tục mua hàng</button>
                <a href="/cart/index" class="btn btn-default">Đơn hàng</a>
            </div>
        </div>

    </div>
</div>
