<?php
/* @var $product common\models\Product */
/* @var $productRelates common\models\Product[] */
?>
<!-- Page Title
============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1><?= $product->name ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a href="/san-pham">Sản Phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $product->name ?></li>
        </ol>
    </div>

</section><!-- #page-title end -->
<!-- Content
    ============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="single-product">
                <div class="product">
                    <div class="col_three_fifth">
                        <!-- Product Single - Gallery
                        ============================================= -->
                        <div class="product-image">
                            <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                                <div class="flexslider">
                                    <div class="slider-wrap" data-lightbox="gallery">
                                        <div class="slide" data-thumb="<?= $product->getThumbnail() ?>"><a
                                                    href="<?= $product->getThumbnail() ?>"
                                                    title="<?= $product->name ?> - Front View"
                                                    data-lightbox="gallery-item"><img
                                                        src="<?= $product->getThumbnail() ?>"
                                                        alt="<?= $product->name ?>"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($product->discount != null || $product->discount != 0) { ?>
                                <div class="sale-flash"> Sale!</div>
                            <?php } ?>
                        </div><!-- Product Single - Gallery End -->
                    </div>
                    <div class="col_two_fifth product-desc col_last">
                        <!-- Product Single - Price
                        ============================================= -->
                        <div class="product-price">
                            <?php if ($product->discount != null || $product->discount != 0) { ?>
                                <del><?= $product->unit_price != null ? number_format($product->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ' ?></del>
                                <ins><?= $product->discount != null ? number_format($product->discount, 0, '', '.') . ' đ' : 'Liên Hệ' ?></ins>
                            <?php } else { ?>
                                <ins><?= $product->unit_price != null ? number_format($product->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ' ?></ins>
                            <?php } ?>
                        </div><!-- Product Single - Price End -->
                        <div class="clear"></div>
                        <div class="line"></div>
                        <!-- Product Single - Quantity & Cart Button
                        ============================================= -->
                        <div class="quantity clearfix">
                            <input type="button" value="-" class="minus">
                            <input type="text" step="1" min="1" name="quantity" value="1" title="Qty" class="qty"
                                   size="4"/>
                            <input type="button" value="+" class="plus">
                        </div>
                        <button class="add-to-cart button nomargin" data-id="<?= $product->id ?>">Thêm Vào Giỏ Hàng</button>
                        <div class="clear"></div>
                        <div class="line"></div>
                        <!-- Product Single - Short Description
                        ============================================= -->
                        <?= $product->short_detail ?>
                        <!-- Product Single - Share
                        ============================================= -->
                        <div class="si-share noborder clearfix">
                            <span>Share:</span>
                            <div>
                                <a href="#" class="social-icon si-borderless si-facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>
                                <a href="#" class="social-icon si-borderless si-twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>
                                <a href="#" class="social-icon si-borderless si-pinterest">
                                    <i class="icon-pinterest"></i>
                                    <i class="icon-pinterest"></i>
                                </a>
                                <a href="#" class="social-icon si-borderless si-gplus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>
                                <a href="#" class="social-icon si-borderless si-rss">
                                    <i class="icon-rss"></i>
                                    <i class="icon-rss"></i>
                                </a>
                                <a href="#" class="social-icon si-borderless si-email3">
                                    <i class="icon-email3"></i>
                                    <i class="icon-email3"></i>
                                </a>
                            </div>
                        </div><!-- Product Single - Share End -->
                    </div>
                    <div class="col_full nobottommargin">
                        <div class="tabs clearfix nobottommargin" id="tab-1">
                            <ul class="tab-nav clearfix">
                                <li><a href="#tabs-1"><i class="icon-align-justify2"></i><span
                                                class="d-none d-md-inline-block"> Mô Tả Sản Phẩm</span></a></li>
                                <li><a href="#tabs-2"><i class="icon-info-sign"></i><span
                                                class="d-none d-md-inline-block"> Thông Tin Sản Phẩm</span></a></li>
                            </ul>
                            <div class="tab-container">
                                <div class="tab-content clearfix" id="tabs-1">
                                    <?= $product->description ?>
                                </div>
                                <div class="tab-content clearfix" id="tabs-2">
                                    <?= $product->technical_detail ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="line"></div>
            <div class="col_full nobottommargin">
                <h4>Sản Phẩm Cùng Loại</h4>
                <div id="oc-product" class="owl-carousel product-carousel carousel-widget" data-margin="30"
                     data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-md="2" data-items-lg="3"
                     data-items-xl="4">
                    <?php
                    /* @var $item common\models\Product */
                    foreach ($productRelates as $item) { ?>
                        <div class="oc-item">
                            <div class="product iproduct clearfix">
                                <div class="product-image">
                                    <a href="<?= $item->url->route ?>"><img src="<?= $item->getThumbnail() ?>"
                                                                            alt="<?= $item->name ?>"></a>
                                    <?php if ($item->discount != null || $item->discount != 0) { ?>
                                        <div class="sale-flash"> Sale!</div>
                                    <?php } ?>
                                    <div class="product-overlay">
                                        <button class="add-to-cart" data-id="<?= $item->id ?>"><i
                                                    class="icon-shopping-cart"></i><span> Đặt Hàng</span></button>
                                        <button class="item-quick-view" data-id="<?= $item->id ?>"><i
                                                    class="icon-zoom-in2"></i><span> Xem Nhanh</span></button>
                                    </div>
                                </div>
                                <div class="product-desc center">
                                    <div class="product-title"><h3><a
                                                    href="<?= $item->url->route ?>"><?= $item->name ?></a></h3></div>
                                    <div class="product-price">
                                        <?php if ($item->discount != null || $item->discount != 0) { ?>
                                            <del><?= $item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ' ?></del>
                                            <ins><?= $item->discount != null ? number_format($item->discount, 0, '', '.') . ' đ' : 'Liên Hệ' ?></ins>
                                        <?php } else { ?>
                                            <ins><?= $item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ' ?></ins>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
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
</section><!-- #content end -->
<?php
$js = <<<JS
$(document).ready(function ($) {
    $('.add-to-cart').click(function() {
        var id = $(this).attr('data-id');
        var quantity = $('.qty').val();
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


