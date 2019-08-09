<?php
$this->title = 'Nguyên liệu pha chế trà sữa tại HCM, Bình Dương, Cần Thơ - Nguyên An'
?>
<section class="main">
    <div class="main-content">
        <div class="index-inner">
            <?php if ($slider): ?>
            <div class="main-slider">
                <div class="main-slider-inner">
                    <?php foreach ($slider as $item):
                        /**@var $item common\models\Slider*/
                        ?>
                    <div class="main-slider-itm"><img src="<?php echo $item->fullPathImageThumbnail?>" alt="<?php $item->title ?>"></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <!-- END: Main slider-->
            <div class="prod-cate section-blk">
                <div class="container">
                    <div class="prod-cate-inner">
                        <div class="blk-ttl">
                            <h3>Danh mục sản phẩm</h3>
                        </div>
                        <div class="cate-list">
                            <div class="cate-slider">
                                <?php


                                $cate = \common\models\Category::find()->visible()->all();
                                $count = 0;
                                foreach ($cate as $itemCate) {
                                    $count ++;
                                    if ($count > 3) {
                                        $count = 1;
                                    }
                                    ?>
                                    <div class="cate-itm cate-<?=$count?>">
                                        <a href="/<?= $itemCate->urls->route ?>">
                                            <div class="cate-ico"><img src="<?= $itemCate->fullPathImageThumbnail ?>"
                                                                       alt width="70" height="50"></div>
                                            <div class="cate-text"><span><?= $itemCate->name ?></span></div>
                                        </a>
                                    </div>
                                    <!-- END: Cate item-->
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Product category-->
            <?php use kartik\dialog\Dialog;

            if ($productBestSeller): ?>
                <div style="background-image: url('/images/best-sell-bg.png')" class="best-seller">
                    <div class="container">
                        <div class="best-seller-inner">
                            <div class="blk-ttl">
                                <h3>Sản phẩm bán chạy</h3>
                            </div>
                            <div class="best-seller-list">
                                <div class="row">
                                    <?php foreach ($productBestSeller as $product): ?>
                                        <?php
                                        if ($product->urls == null) {
                                            continue;
                                        }
                                        $route = $product->urls->route;
                                        /** @var \common\models\Product $product */
                                        ?>
                                        <div class="best-seller-itm col-md-3 col-sm-6 col-xs-12">
                                            <div class="best-seller-item-inner">
                                                <div class="inner">
                                                    <a href="<?= $route ?>">
                                                        <div class="best-seller-img">
                                                            <img src="<?= $product->fullPathImageThumbnail ?>" style="width: 70%" alt>
                                                            <?php
                                                            if ($product->discount != null || $product->discount != '') {
                                                                $discount = $product->discount / $product->unit_price * 100;
                                                                ?>
                                                                <img class="discount" src="/images/icon-discount.png">
                                                                <span><?=100 - round($discount)?>%</span>
                                                                <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </a>
                                                    <div class="best-seller-desc">
                                                        <p class="name"><?= $product->name ?></p>
                                                        <p class="price">
                                                            <?php
                                                                if ($product->discount != null || $product->discount != '') {
                                                                    echo ($product->discount != null ? number_format($product->discount, 0, '', '.') . ' đ' : 'Liên Hệ')."<del style='color: grey; padding-left: 10px;font-size: 12px'>".($product->unit_price != null ? number_format($product->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ')."</del>";
                                                                } else {
                                                                    echo ($product->unit_price != null ? number_format($product->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ');
                                                                }

                                                            ?>
                                                        </p>
                                                        <button class="buy-prod" data-id="<?= $product->id ?>"
                                                                data-name="<?= $product->name ?>">Mua hàng
                                                        </button>
                                                        <a href="javascript:;" data-id="<?= $product->id ?>"
                                                           class="view-prod"><i class="fa fa-eye"></i></a><a
                                                                href="#" class="add-wish"><i
                                                                    class="fa fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Best seller item-->
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Best seller-->
            <?php endif; ?>

            <!--   list category-->
            <?php if ($categories): ?>
                <?php
                /** @var \common\models\Category $category */
                foreach ($categories as $category):
//                    $product=$category->products;
                    $product = \common\models\Product::find()->where(['category_id'=>$category->id])->visible()->limit($category->number)->all();
                    if ($category->is_show==0)
                        continue;
                    ?>
                    <?php if (count($product) != 0): ?>
                    <div class="index-prod-blk">
                        <div class="container">
                            <div class="idex-prod-inner">
                                <div class="blk-ttl">
                                    <h3><?php echo $category->name ?></h3>
                                </div>
                                <div class="i-prod-slider">
                                    <?php
                                    if (count($product) != 0) {
                                        foreach ($product as $item): ?>
                                            <?php
                                            if ($item->urls == null) {
                                                continue;
                                            }
                                            $route = $item->urls->route;
                                            /** @var \common\models\Product $product */
                                            ?>
                                            <div class="prod-itm">
                                                <div class="i-prod-inner">
                                                    <div class="i-prod-img">
                                                        <a href="<?= $route ?>">
                                                            <img src="<?php echo $item->fullPathImageThumbnail ?>" style="width: 70%" alt>
                                                            <?php
                                                            if ($item->discount != null || $item->discount != '') {
                                                                $discountItem = $item->discount / $item->unit_price * 100;
                                                                ?>
                                                                <img class="discount" src="/images/icon-discount.png">
                                                                <span><?=100 - round($discountItem)?>%</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </a>
                                                    </div>
                                                    <div class="i-prod-desc">
                                                        <a href="<?= $route ?>" class="i-prod-desc-name"><p
                                                                    class="name"><?php echo $item->name ?></p></a>
                                                        <p class="price">
                                                            <?php
                                                            if ($item->discount != null || $item->discount != '') {
                                                                echo ($item->discount != null ? number_format($item->discount, 0, '', '.') : 'Liên Hệ')."đ<del style='color: grey; padding-left: 10px;font-size: 12px'>".($item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ')."</del>";
                                                            } else {
                                                                echo ($item->unit_price != null ? number_format($item->unit_price, 0, '', '.') : 'Liên Hệ').'đ';
                                                            }
                                                            ?>
                                                        </p>
                                                        <button class="buy-prod" data-id="<?= $item->id ?>"
                                                                data-name="<?= $item->name ?>">Mua hàng
                                                        </button>
                                                        <a href="javascript:;" data-id="<?= $item->id ?>"
                                                           class="view-prod"><i class="fa fa-eye"></i></a><a
                                                                href="#" class="add-wish"><i
                                                                    class="fa fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END: Index product item-->
                                        <?php endforeach;
                                    } ?>
                                </div>
                                <div class="view-more-prod text-center"><a href="/<?php echo $category->urls->route ?>">Xem
                                        thêm</a></div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Index product-->
                <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
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
});
$('.cate-1').css('background-color','#5b8827');
$('.cate-2').css('background-color','#c8e34c');
$('.cate-3').css('background-color','#96b12b');
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

