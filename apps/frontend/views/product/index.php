<?php

/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/16/2018
 * Time: 2:08 PM
 */

/* @var $this \yii\web\View */
/* @var $product array|\common\models\Product[]|\yii\db\ActiveRecord[] */
/* @var $category array|\common\models\Category[]|\yii\db\ActiveRecord[] */

$this->title = 'Danh sách sản phẩm'
?>
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="postcontent nobottommargin col_last">
                <div id="shop" class="shop product-3 grid-container clearfix">
                    <?php if ($product == null) { ?>
                        echo 'Không có sản phẩm nào phù hợp với kết quả tìm kiếm.';
                    <?php } else {
                        foreach ($product as $item) {
                            if ($item->url == null) {
                                continue;
                            }
                            echo $this->render('_item', ['item' => $item]);
                        }
                    } ?>
                </div>
            </div>

            <div class="sidebar nobottommargin">
                <div class="sidebar-widgets-wrap">
                    <div class="widget widget-filter-links clearfix">
                        <h4>Danh Mục Sản Phẩm</h4>
                        <ul class="custom-filter" data-container="#shop" data-active-class="active-filter">
                            <li class="widget-filter-reset active-filter"><a href="#" data-filter="*">Clear</a></li>
                            <?php
                            if ($category != null) {
                                foreach ($category as $item) { ?>
                                    <li><a href="/product/category?id=<?= $item->id ?>"><?= $item->name ?></a></li>
                                <?php }
                            } ?>
                        </ul>
                    </div>
                    <div class="widget widget-filter-links clearfix">
                        <h4>Sắp xếp</h4>
                        <ul class="shop-sorting">
                            <li class="widget-filter-reset active-filter"><a href="#" data-sort-by="original-order">Clear</a>
                            </li>
                            <li><a href="#" data-sort-by="name">Tên</a></li>
                            <li><a href="#" data-sort-by="price_lh">Giá: Thấp đến Cao</a></li>
                            <li><a href="#" data-sort-by="price_hl">Giá: Cao đến Thấp</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
