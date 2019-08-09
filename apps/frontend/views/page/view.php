<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
$this->title = $model->title;
?>
<!--<section class="main">-->
<!--    <div class="main-content">-->
<!--        <div style="background-image: url('/images/rule.png')" class="main-banner"></div>-->
<!--        <div class="breadcrumb-blk">-->
<!--            <div class="container">-->
<!--                <p>Trang chủ / --><?php //echo $model->title ?><!--</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="container">-->
<!--            <div class="rule-content">-->
<!--                <h1 class="text-uppercase text-center">--><?php //echo $model->title ?><!--</h1>-->
<!--                --><?php //echo $model->body ?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<section class="main">
    <div class="main-content">
        <div style="background-image: url('/images/rule.png')" class="main-banner"></div>
        <div class="breadcrumb-blk">
            <div class="container">
                <p>Trang chủ / <?php echo $model->title ?></p>
            </div>
        </div>
        <div class="container">
            <div class="rule-content">
                <h1 class="text-uppercase text-center"><?php echo $model->title ?></h1>
                <?php echo $model->body ?>
            </div>
        </div>
    </div>
</section>