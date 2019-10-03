<?php

use common\models\Product;
use common\models\Slider;
use yii\web\JqueryAsset;

/* @var $slider array|\common\models\Slider[]|\yii\db\ActiveRecord[] */
/* @var $category array|\common\models\Category[]|\yii\db\ActiveRecord[] */

$this->title = 'Khăn Giấy Thiện Tâm';
?>
<?php if ($slider != null) { ?>
    <section id="slider" class="slider-element slider-parallax revslider-wrap ohidden clearfix">
        <div id="rev_slider_ishop_wrapper" class="rev_slider_wrapper fullwidth-container" data-alias="default-slider"
             style="padding:0px;">
            <div id="rev_slider_ishop" class="rev_slider fullwidthbanner" style="display:none;" data-version="5.1.4">
                <ul>
                    <?php foreach ($slider as $item) { ?>
                        <li data-transition="fade" data-slotamount="1" data-masterspeed="1500" data-delay="5000"
                            data-saveperformance="off" data-title="Latest Collections"
                            style="background-color: #F6F6F6;">
                            <div class="tp-caption ltl tp-resizeme revo-slider-caps-text uppercase"
                                 data-x="0"
                                 data-y="0"
                                 data-transform_in="x:-200;y:0;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;s:700;e:Power4.easeOutQuad;"
                                 data-speed="400"
                                 data-start="1000"
                                 data-easing="easeOutQuad"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-elementdelay="0.01"
                                 data-endelementdelay="0.1"
                                 data-endspeed="1000"
                                 data-endeasing="Power4.easeIn" style=""><img src="<?= Slider::getImage($item->id) ?>"
                                                                              alt="Girl">
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
<?php } ?>


<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="tabs topmargin-lg clearfix" id="tab-3">
                <?php if ($category != null) { ?>
                    <ul class="tab-nav clearfix">
                        <?php foreach ($category as $item) { ?>
                            <li><a href="#<?= $item->id ?>"><?= $item->name ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-container">
                        <?php foreach ($category as $item) {
                            $listProduct = Product::findAll(['category_id' => $item->id]); ?>
                            <div class="tab-content clearfix" id="<?= $item->id ?>">
                                <div id="shop" class="shop clearfix">
                                    <?php if ($listProduct == null) { ?>
                                        echo 'Không có sản phẩm nào phù hợp với kết quả tìm kiếm.';
                                    <?php } else {
                                        foreach ($listProduct as $product) {
                                            echo $this->render('_item', ['item' => $product]);
                                        }
                                    } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>

            <div class="clear bottommargin-sm"></div>

            <div class="col_one_third">
                <div class="fancy-title title-border">
                    <h4>About Us</h4>
                </div>
                <p>Jane Jacobs educate, leverage affiliate Martin Luther King Jr. agriculture conflict resolution
                    dignity. Cooperation international progress non-partisan lasting change meaningful.</p>
            </div>

            <div class="col_one_third subscribe-widget">
                <div class="fancy-title title-border">
                    <h4>Subscribe for Offers</h4>
                </div>
                <p>Subscribe to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</p>
                <div class="widget-subscribe-form-result"></div>
                <form id="widget-subscribe-form2" action="include/subscribe.php" role="form" method="post"
                      class="nobottommargin">
                    <div class="input-group divcenter">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="icon-email2"></i></div>
                        </div>
                        <input type="email" name="widget-subscribe-form-email" class="form-control required email"
                               placeholder="Enter your Email">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col_one_third col_last">
                <div class="fancy-title title-border">
                    <h4>Connect with Us</h4>
                </div>

                <a href="#" class="social-icon si-facebook" data-toggle="tooltip" data-placement="top"
                   title="Facebook">
                    <i class="icon-facebook"></i>
                    <i class="icon-facebook"></i>
                </a>

                <a href="#" class="social-icon si-delicious" data-toggle="tooltip" data-placement="top"
                   title="Delicious">
                    <i class="icon-delicious"></i>
                    <i class="icon-delicious"></i>
                </a>

                <a href="#" class="social-icon si-paypal" data-toggle="tooltip" data-placement="top" title="PayPal">
                    <i class="icon-paypal"></i>
                    <i class="icon-paypal"></i>
                </a>

                <a href="#" class="social-icon si-flattr" data-toggle="tooltip" data-placement="top" title="Flattr">
                    <i class="icon-flattr"></i>
                    <i class="icon-flattr"></i>
                </a>

                <a href="#" class="social-icon si-android" data-toggle="tooltip" data-placement="top"
                   title="Android">
                    <i class="icon-android"></i>
                    <i class="icon-android"></i>
                </a>

                <a href="#" class="social-icon si-smashmag" data-toggle="tooltip" data-placement="top"
                   title="Smashing Magazine">
                    <i class="icon-smashmag"></i>
                    <i class="icon-smashmag"></i>
                </a>

                <a href="#" class="social-icon si-gplus" data-toggle="tooltip" data-placement="top" title="Google+">
                    <i class="icon-gplus"></i>
                    <i class="icon-gplus"></i>
                </a>

                <a href="#" class="social-icon si-wikipedia" data-toggle="tooltip" data-placement="top"
                   title="Wikipedia">
                    <i class="icon-wikipedia"></i>
                    <i class="icon-wikipedia"></i>
                </a>

                <a href="#" class="social-icon si-stumbleupon" data-toggle="tooltip" data-placement="top"
                   title="StumbleUpon">
                    <i class="icon-stumbleupon"></i>
                    <i class="icon-stumbleupon"></i>
                </a>

                <a href="#" class="social-icon si-foursquare" data-toggle="tooltip" data-placement="top"
                   title="FourSquare">
                    <i class="icon-foursquare"></i>
                    <i class="icon-foursquare"></i>
                </a>

                <a href="#" class="social-icon si-call" data-toggle="tooltip" data-placement="top" title="Call">
                    <i class="icon-call"></i>
                    <i class="icon-call"></i>
                </a>

                <a href="#" class="social-icon si-ninetyninedesigns" data-toggle="tooltip" data-placement="top"
                   title="Ninety Nine Design">
                    <i class="icon-ninetyninedesigns"></i>
                    <i class="icon-ninetyninedesigns"></i>
                </a>

                <a href="#" class="social-icon si-forrst" data-toggle="tooltip" data-placement="top" title="Forrst">
                    <i class="icon-forrst"></i>
                    <i class="icon-forrst"></i>
                </a>

                <a href="#" class="social-icon si-digg" data-toggle="tooltip" data-placement="top" title="Digg">
                    <i class="icon-digg"></i>
                    <i class="icon-digg"></i>
                </a>
            </div>

            <div class="clear"></div>

            <div class="fancy-title title-border title-center topmargin-sm">
                <h4>Popular Brands</h4>
            </div>

            <ul class="clients-grid grid-6 nobottommargin clearfix">
                <li><a href="#"><img src="/images/clients/logo/1.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/2.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/3.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/4.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/5.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/6.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/7.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/8.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/9.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/10.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/11.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/12.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/13.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/14.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/15.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/16.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/19.png" alt="Clients"></a></li>
                <li><a href="#"><img src="/images/clients/logo/18.png" alt="Clients"></a></li>
            </ul>

        </div>

        <div class="section nobottommargin">
            <div class="container clearfix">

                <div class="col_one_fourth nobottommargin">
                    <div class="feature-box fbox-plain fbox-dark fbox-small">
                        <div class="fbox-icon">
                            <i class="icon-thumbs-up2"></i>
                        </div>
                        <h3>100% Original</h3>
                        <p class="notopmargin">We guarantee you the sale of Original Brands.</p>
                    </div>
                </div>

                <div class="col_one_fourth nobottommargin">
                    <div class="feature-box fbox-plain fbox-dark fbox-small">
                        <div class="fbox-icon">
                            <i class="icon-credit-cards"></i>
                        </div>
                        <h3>Payment Options</h3>
                        <p class="notopmargin">We accept Visa, MasterCard and American Express.</p>
                    </div>
                </div>

                <div class="col_one_fourth nobottommargin">
                    <div class="feature-box fbox-plain fbox-dark fbox-small">
                        <div class="fbox-icon">
                            <i class="icon-truck2"></i>
                        </div>
                        <h3>Free Shipping</h3>
                        <p class="notopmargin">Free Delivery to 100+ Locations on orders above $40.</p>
                    </div>
                </div>

                <div class="col_one_fourth nobottommargin col_last">
                    <div class="feature-box fbox-plain fbox-dark fbox-small">
                        <div class="fbox-icon">
                            <i class="icon-undo"></i>
                        </div>
                        <h3>30-Days Returns</h3>
                        <p class="notopmargin">Return or exchange items purchased within 30 days.</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="section notopborder nobottomborder nomargin nopadding nobg footer-stick">
            <div class="container clearfix">

                <div class="col_half nobottommargin topmargin">
                    <img src="/images/services/4.jpg" alt="Image" class="nobottommargin">
                </div>

                <div class="col_half subscribe-widget nobottommargin col_last">

                    <div class="heading-block topmargin-lg">
                        <h3><strong>GET 20% OFF*</strong></h3>
                        <span>Our App scales beautifully to different Devices.</span>
                    </div>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet cumque, perferendis
                        accusamus
                        porro illo exercitationem molestias.</p>

                    <div class="widget-subscribe-form-result"></div>
                    <form id="widget-subscribe-form3" action="include/subscribe.php" role="form" method="post"
                          class="nobottommargin">
                        <div class="input-group" style="max-width:400px;">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="icon-email2"></i></div>
                            </div>
                            <input type="email" name="widget-subscribe-form-email"
                                   class="form-control required email"
                                   placeholder="Enter your Email">
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="submit">Subscribe Now</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>

</section><!-- #content end -->

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