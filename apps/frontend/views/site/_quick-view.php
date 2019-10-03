<?php
/* @var $product \common\models\Product */
?>
<div class="row">
    <div class="col-md-5">
        <img src="<?= $product->getThumbnail() ?>" style="width: 100%">
    </div>
    <div class="col-md-7">
        <a href="/"><h2 style="margin-bottom: 20px"><?= $product->name ?></h2></a>
        <div class="quick-view-price" style="margin-bottom: 10px">
            <span style="font-size: 20px;color: #e32124;font-weight: bold"><?= number_format($product->unit_price) ?>đ</span>
        </div>
        <a href="/cart/add-to-cart?id=<?= $product->id ?>" class="btn btn-primary">Thêm vào giỏ hàng</a>
    </div>
</div>
