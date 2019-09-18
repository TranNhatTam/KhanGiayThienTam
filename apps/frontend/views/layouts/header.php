<?php

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

            <p class="nobottommargin"><strong>Call:</strong> 1800-547-2145 | <strong>Email:</strong> info@canvas.com</p>

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
                <a href="/" class="standard-logo" data-dark-logo="images/logo-dark.png"><img src="/images/logo.png"
                                                                                             alt="Canvas Logo"></a>
                <a href="/" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img src="/images/logo@2x.png"
                                                                                              alt="Canvas Logo"></a>
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
                <?php Pjax::begin(['id' => 'top-cart', 'timeout' => 5000]); ?>
                <a href="/cart/index" id="go-to-cart"><i
                            class="icon-shopping-cart"></i><span><?= Yii::$app->carts->getCount() ?></span></a>
                <?php
                $js = <<<JS
    $('#go-to-cart').click(function() {
        window.location.href = '/cart/index';
    })
JS;
                $this->registerJs($js);
                Pjax::end(); ?>
                <!-- #top-cart end -->
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
