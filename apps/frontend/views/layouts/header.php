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

            <p class="nobottommargin"><strong>Call:</strong> 0909 453 218 | <strong>Email:</strong> khanlanhthientam@gmail.com</p>

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
