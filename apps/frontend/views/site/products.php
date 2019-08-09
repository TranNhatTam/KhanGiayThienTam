<section class="main">
    <div class="main-content">
        <div style="background-image: url('/images/best-sell-bg.png')" class="main-banner"></div>
        <div class="breadcrumb-blk">
            <div class="container">
                <p>Trang chủ / Sản phẩm</p>
            </div>
        </div>
        <div class="product-list">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <?php if ($categories): ?>
                        <div class="prod-filt-list">
                            <div class="filt-ttl">
                                <p>Lọc sản phẩm</p>
                            </div>
                            <div class="filt-inner">
                                <div class="filt-list">
                                    <ul>
                                        <?php foreach ($categories as $category): ?>
                                        <li><a href="#" class="filt-itm"><span><?php echo $category->name?></span></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- END: Filter blk-->
                        <?php if ($brands): ?>
                        <div class="prod-filt-list">
                            <div class="filt-ttl">
                                <p>Thương hiệu</p>
                            </div>
                            <div class="filt-inner">
                                <div class="filt-frm">
                                    <input type="text" placeholder="Tên thương hiệu">
                                    <button><i class="fa fa-search"></i></button>
                                </div>
                                <div class="filt-list">
                                    <?php $count=1; foreach ($brands as $brand): ?>
                                    <div class="cus-chk">
                                        <input id="chk<?= $count?>" type="checkbox">
                                        <label for="chk<?= $count?>"><span><?php echo $brand->name; $count++?></span></label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- END: Category-->
                    <div class="col-md-9 col-xs-12">
                        <div class="product-list-inner">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="prod-itm">
                                        <div class="i-prod-inner">
                                            <div class="i-prod-img"><img src="/uploads/prod-4.jpg" alt></div>
                                            <div class="i-prod-desc">
                                                <p class="name">Đậu đỏ Hàn Quốc</p>
                                                <p class="price">240.000 đ</p>
                                                <button class="buy-prod">Mua hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Product item-->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="prod-itm">
                                        <div class="i-prod-inner">
                                            <div class="i-prod-img"><img src="/uploads/prod-4.jpg" alt></div>
                                            <div class="i-prod-desc">
                                                <p class="name">Đậu đỏ Hàn Quốc</p>
                                                <p class="price">240.000 đ</p>
                                                <button class="buy-prod">Mua hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Product item-->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="prod-itm">
                                        <div class="i-prod-inner">
                                            <div class="i-prod-img"><img src="/uploads/prod-4.jpg" alt></div>
                                            <div class="i-prod-desc">
                                                <p class="name">Đậu đỏ Hàn Quốc</p>
                                                <p class="price">240.000 đ</p>
                                                <button class="buy-prod">Mua hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Product item-->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="prod-itm">
                                        <div class="i-prod-inner">
                                            <div class="i-prod-img"><img src="/uploads/prod-4.jpg" alt></div>
                                            <div class="i-prod-desc">
                                                <p class="name">Đậu đỏ Hàn Quốc</p>
                                                <p class="price">240.000 đ</p>
                                                <button class="buy-prod">Mua hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Product item-->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="prod-itm">
                                        <div class="i-prod-inner">
                                            <div class="i-prod-img"><img src="/uploads/prod-4.jpg" alt></div>
                                            <div class="i-prod-desc">
                                                <p class="name">Đậu đỏ Hàn Quốc</p>
                                                <p class="price">240.000 đ</p>
                                                <button class="buy-prod">Mua hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Product item-->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="prod-itm">
                                        <div class="i-prod-inner">
                                            <div class="i-prod-img"><img src="/uploads/prod-4.jpg" alt></div>
                                            <div class="i-prod-desc">
                                                <p class="name">Đậu đỏ Hàn Quốc</p>
                                                <p class="price">240.000 đ</p>
                                                <button class="buy-prod">Mua hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Product item-->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="prod-itm">
                                        <div class="i-prod-inner">
                                            <div class="i-prod-img"><img src="/uploads/prod-4.jpg" alt></div>
                                            <div class="i-prod-desc">
                                                <p class="name">Đậu đỏ Hàn Quốc</p>
                                                <p class="price">240.000 đ</p>
                                                <button class="buy-prod">Mua hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Product item-->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="prod-itm">
                                        <div class="i-prod-inner">
                                            <div class="i-prod-img"><img src="/uploads/prod-4.jpg" alt></div>
                                            <div class="i-prod-desc">
                                                <p class="name">Đậu đỏ Hàn Quốc</p>
                                                <p class="price">240.000 đ</p>
                                                <button class="buy-prod">Mua hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Product item-->
                            </div>
                            <div class="view-more-prod text-center"><a href="#">Xem thêm</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>