<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/16/2018
 * Time: 5:18 AM
 */

use common\models\Category;
use common\models\Business;

$category = Category::find()->orderBy(['priority' => SORT_ASC])->visible()->all();
$business = Business::find()->one();
?>
<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-md-4 fast-ship">
                <div class="fast-ship-inner"><a href="tel:091 533 87 47" class="fast-ship-btn"><i
                                class="fa fa-phone"></i><span class="txt">Đặt hàng nhanh</span><span class="phone-numb"><?php echo $business->hot_line ?></span></a>
                </div>
            </div>
            <div class="col-md-4 logo-blk">
                <div class="logo-inner text-center"><a href="/" class="logo-btn"><img src="<?php echo $business->fullPathImageThumbnail?>" alt></a>
                </div>
            </div>
            <div class="col-md-4 account-blk text-right"><a href="javascript:;" class="account-btn"><span>Đăng nhập / Đăng ký</span><i
                            class="ico"></i></a></div>
        </div>
    </div>
</div>
<!-- END: Top header-->
<div class="main-menu-blk">
    <div class="container">
        <div class="main-menu-inner">
            <a href="javascript:;" class="responsive-menu"><i class="fa fa-bars"></i></a><a href="javascript:;"
                                                                                            class="close-menu"><i
                        class="fa fa-close"></i></a>
            <ul class="main-menu-ul">
                <li><a href="/" class="menu-itm"><span>Trang chủ</span></a></li>
                <li><a href="/product/index" class="menu-itm"><span>Sản phẩm</span></a>
                    <div class="sub-menu">
                        <?php if ($category): ?>
                            <ul class="sub-menu-ul">
                                <?php foreach ($category as $item): ?>
                                    <li><a href="/<?= $item->urls->route ?>" class="sub-menu-itm">
                                            <span><?php echo $item->name ?></span></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </li>
                <li><a href="/page/<?php echo \common\models\Page::RULE ?>"
                       class="menu-itm"><span>Chính sách & quy định</span></a></li>
                <li><a href="/site/blog" class="menu-itm"><span>Blog</span></a></li>
            </ul>
        </div>
        <!-- END: Main menu-->
        <div class="search-blk">
            <div class="search-inner clearfix">
                <form action="/search/" method="get">
                    <input type="text" name="filter" placeholder="Nhập tên sản phẩm" class="search-ipt">
                    <button class="search-submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <!-- END: Search block-->
        <div class="shopping-cart-blk">
            <?php
            \yii\widgets\Pjax::begin(['id' => 'header-cart-pjax', 'timeout' => 5000]);
            ?>
            <a href="javascript:;" class="shopping-cart-btn"></a>
            <span class="cart-numb"><?= Yii::$app->carts->getCount() ?></span>
            <div class="shopping-cart-popup">
                <div class="popup-inner">
                    <div id="h-cart-body" class="popup-body">
                        <?php
                        /* @var $item \common\models\Product */
                        $product = Yii::$app->carts->getItems();
                        foreach ($product as $item) {
                            ?>
                            <div class="h-cart-itm clearfix">
                                <div class="h-cart-img"><img src="<?= $item->fullPathImageThumbnail ?>" alt></div>
                                <div class="h-cart-info">
                                    <h3><?= $item->name ?></h3>
                                    <p><span class="ttl">Số lượng: </span><span
                                                class="val"><?= $item->quantity ?></span></p>
                                    <p><span class="ttl">Đơn giá: </span><span
                                                class="val"><?php
                                            if ($item->discount != null || $item->discount != '') {
                                                echo ($item->unit_price != null ? number_format($item->discount, 0, '', '.') . ' đ' : 'Liên Hệ');
                                            } else {
                                                echo ($item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ');
                                            }

                                            ?></span>
                                    </p>
                                </div>
                            </div>
                            <!-- END: Header cart item-->
                            <?php
                        }
                        ?>
                    </div>
                    <div class="popup-ft"><a href="javascript:;" class="go-to-cart">Xem giỏ hàng</a></div>
                </div>
            </div>
            <?php
            $js = <<<JS
    $('.go-to-cart').click(function() {
        window.location.href = '/cart/index';
    })
JS;
            $this->registerJs($js);
            ?>
            <?php
            \yii\widgets\Pjax::end();
            ?>

        </div>

    </div>
</div>
