<?php

use common\models\Product;
use frontend\assets\FrontendAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<style>

    .revo-slider-emphasis-text {
        font-size: 58px;
        font-weight: 700;
        letter-spacing: 1px;
        font-family: 'Raleway', sans-serif;
        padding: 15px 20px;
        border-top: 2px solid #FFF;
        border-bottom: 2px solid #FFF;
    }

    .revo-slider-desc-text {
        font-size: 20px;
        font-family: 'Lato', sans-serif;
        width: 650px;
        text-align: center;
        line-height: 1.5;
    }

    .revo-slider-caps-text {
        font-size: 16px;
        font-weight: 400;
        letter-spacing: 3px;
        font-family: 'Raleway', sans-serif;
    }

    .tp-video-play-button {
        display: none !important;
    }

    .tp-caption {
        white-space: nowrap;
    }

</style>
<!-- Top Bar
============================================= -->
<div id="top-bar" class="d-none d-md-block">

    <div class="container clearfix">

        <div class="col_half nobottommargin">

            <p class="nobottommargin"><strong>Call:</strong> 0909 453 218 | <strong>Email:</strong>
                khanlanhthientam@gmail.com</p>

        </div>

        <div class="col_half col_last fright nobottommargin">

            <!-- Top Links
            ============================================= -->
            <div class="top-links">
                <ul>
                    <li><a href="#">Login</a>
                        <div class="top-link-section">
                            <form id="top-login" role="form">
                                <div class="input-group" id="top-login-username">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="icon-user"></i></div>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email address" required="">
                                </div>
                                <div class="input-group" id="top-login-password">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="icon-key"></i></div>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Password" required="">
                                </div>
                                <label class="checkbox">
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                                <button class="btn btn-danger btn-block" type="submit">Sign in</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div><!-- .top-links end -->

        </div>

    </div>

</div><!-- #top-bar end -->

<header id="header">
    <div id="header-wrap">
        <div class="container clearfix">
            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
            <!-- Logo
            ============================================= -->
            <div id="logo">
                <a href="/" class="standard-logo" data-dark-logo="images/logo-dark.png" style="padding-top: 10px;">
                    <img src="/images/logo/a.png" alt="Thiện Tâm Logo" style="width: 80px;height:80px;"></a>
            </div><!-- #logo end -->
            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu">
                <ul>
                    <li><a href="/">
                            <div>Trang Chủ</div>
                        </a></li>
                    <li><a href="/site/about">
                            <div>Giới Thiệu</div>
                        </a></li>
                    <li><a href="/san-pham">
                            <div>Sản Phẩm</div>
                        </a></li>
                    <li><a href="/site/gallery">
                            <div>Dịch Vụ</div>
                        </a></li>
                    <li><a href="#">
                            <div>Ưu Đãi</div>
                        </a></li>
                    <li><a href="/site/blog">
                            <div>Tin Tức</div>
                        </a></li>
                    <li><a href="/site/contact">
                            <div>Liên Hệ</div>
                        </a></li>
                </ul>

                <!-- Top Cart
                ============================================= -->
                <div id="top-cart">
                    <a href="#" id="top-cart-trigger"><i class="icon-shopping-cart"></i>
                        <span>
                         <?php Pjax::begin(['id' => 'cart-count', 'timeout' => 5000]); ?>
                         <?= Yii::$app->carts->getCount() ?>
                         <?php Pjax::end(); ?>
                    </span>
                    </a>
                    <div class="top-cart-content">
                        <div class="top-cart-title">
                            <h4>Shopping Cart</h4>
                        </div>
                        <?php Pjax::begin(['id' => 'cart-info', 'timeout' => 5000]); ?>
                        <div class="top-cart-items">
                            <?php
                            $total = 0;
                            if (Yii::$app->carts->getCount() > 0) {
                                /* @var $item \common\models\Product */
                                $product = Yii::$app->carts->getItems();
                                foreach ($product as $item) {
                                    $product = Product::findOne($item->id); ?>
                                    <div class="top-cart-item clearfix">
                                        <div class="top-cart-item-image">
                                            <img src="<?= $product->getThumbnail() ?>" alt="<?= $product->name ?>"/>
                                        </div>
                                        <div class="top-cart-item-desc">
                                            <p class="item-desc"><?= $item->name ?></p>
                                            <span class="top-cart-item-price">
                                                <?php
                                                if ($item->discount != null || $item->discount != 0) {
                                                    echo($item->unit_price != null ? number_format($item->discount, 0, '', '.') . ' đ' : 'Liên Hệ');
                                                } else {
                                                    echo($item->unit_price != null ? number_format($item->unit_price, 0, '', '.') . ' đ' : 'Liên Hệ');
                                                }
                                                ?>
                                            </span>
                                            <span class="top-cart-item-quantity">x <?= $item->quantity ?></span>
                                        </div>
                                    </div>
                                    <?php
                                    $total += $item->unit_price * $item->quantity;
                                }
                            } ?>
                        </div>
                        <div class="top-cart-action clearfix">
                            <span class="fleft top-checkout-price"><?php echo($total != null ? number_format($total, 0, '', '.') . ' đ' : 'Liên Hệ'); ?></span>
                            <button class="button button-3d button-small nomargin fright"
                                    onclick="location.href='/cart/index';">View Cart
                            </button>
                        </div>
                        <?php Pjax::end(); ?>
                    </div>
                </div>

                <!-- Top Search
                ============================================= -->
                <div id="top-search">
                    <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
                    <form action="search.html" method="get">
                        <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
                    </form>
                </div><!-- #top-search end -->

            </nav><!-- #primary-menu end -->
        </div>
    </div>
</header><!-- #header end -->
