<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/16/2018
 * Time: 5:19 AM
 */
use common\models\Address;
use common\models\Business;
$business = Business::find()->one();
$address = Address::find()->all();
?>
<a href="javascript:;" class="backtop"><i class="fa fa-chevron-up"></i></a>
<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-6 top-ft-itm">
                <div class="top-ft-inner">
                    <div style="background-image: url('/images/icons/ft-ico-1.png')" class="ico"></div>
                    <div class="top-ft-txt">
                        <p class="text-uppercase">Miễn phí vận chuyển</p>
                        <span>Nhận hàng trong vòng 3 ngày</span>
                    </div>
                </div>
            </div>
            <!-- END: Footer top itm-->
            <div class="col-md-3 col-xs-12 col-sm-6 top-ft-itm">
                <div class="top-ft-inner">
                    <div style="background-image: url('/images/icons/ft-ico-2.png')" class="ico"></div>
                    <div class="top-ft-txt">
                        <p class="text-uppercase">Giảm 100.000</p><span>Đơn hàng đầu tiên trên 3 triệu</span>
                    </div>
                </div>
            </div>
            <!-- END: Footer top itm-->
            <div class="col-md-3 col-xs-12 col-sm-6 top-ft-itm">
                <div class="top-ft-inner">
                    <div style="background-image: url('/images/icons/ft-ico-3.png')" class="ico"></div>
                    <div class="top-ft-txt">
                        <p class="text-uppercase">Poster quảng cáo</p><span>Khuyến mãi cho khách hàng</span>
                    </div>
                </div>
            </div>
            <!-- END: Footer top itm-->
            <div class="col-md-3 col-xs-12 col-sm-6 top-ft-itm">
                <div class="top-ft-inner">
                    <div style="background-image: url('/images/icons/ft-ico-4.png')" class="ico"></div>
                    <div class="top-ft-txt">
                        <p class="text-uppercase">Hotline</p><span><?php echo $business->hot_line?></span>
                    </div>
                </div>
            </div>
            <!-- END: Footer top itm-->
        </div>
    </div>
</div>
<div class="footer-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="contact-info ft-col">
                    <div class="ft-head">
                        <h3 class="text-uppercase">Thông tin liên hệ</h3>
                    </div>
                    <div class="ft-inner">
                        <?php foreach ($address as $item): ?>
                        <p><strong><?php echo $item->name?>: </strong><span><?php echo $item->address?></span></p>
                        <?php endforeach; ?>
                        <p><strong>Điện thoại: </strong><span><?php echo $business->phone?></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="ft-col company-info">
                    <div class="ft-head">
                        <h3 class="text-uppercase">Thông tin công ty</h3>
                    </div>
                    <div class="ft-inner">
                        <p>Công ty TNHH Phân Phối Nguyên Liệu Nguyên An</p>
                        <p>Đại diện: ông Phan Phương Thuận</p>
                        <p>Giấy phép ĐKKD só 0314007493 cấp ngày 13/09/2016</p>
                        <p>Cấp bởi Sở Kế hoạch Đầu tư TP.HCM</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="ft-col bct" style="margin-right: 29px; margin-top: 14px;">
                    <a href="<?php echo $business->link_facebook?>"><img style="width: 14%; margin: 7px 9px 6px 0px" src="/img/facebook.png"></a>
                    <a href="<?php echo $business->link_skype?>"><img style="width: 14%; margin: 7px 9px 6px 0px" src="/img/skype.png"></a>
                    <a href="<?php echo $business->link_google_plus?>"><img style="width: 14%; margin: 7px 9px 6px 0px" src="/img/google-plus.png"></a>
                </div>


            </div>
        </div>
    </div>
</div>
