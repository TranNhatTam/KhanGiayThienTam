<?php
/* @var $this yii\web\View */
/* @var $model common\models\Article */
?>
<section class="main">
    <div class="main-content">
        <div class="news-content">
            <div class="container">
                <div class="news-detail-blk">
                    <div class="row">
                        <div class="col-md-9 col-xs-12">
                            <div class="news-detail-content">
                                <div class="news-detail-ttl">
                                    <h1><?php echo $model->title?></h1>
                                </div>
                                <div class="news-detail-inner">
                                    <?php echo $model->body?>
                                </div>
                            </div>
                        </div>
                        <!-- END: News detail content-->
                        <?php if ($blog_df): ?>
                        <div class="col-md-3 col-xs-12">
                            <div class="news-related clearfix">
                                <h3>Tin tức liên quan</h3>
                                <?php foreach ($blog_df as $item): ?>
                                    <a href="/article/<?php echo $item->slug ?>" class="news-related-itm">
                                    <div class="news-related-img"><img src="<?php echo $item->fullPathImageThumbnail?>" alt style="max-width: 120px;max-height: 83px"></div>
                                    <div class="news-related-ttl">
                                        <p><?php echo $item->title?></p>
                                    </div></a>
                                    <!-- END: Related item--><a href="/article/<?php echo $item->slug ?>" class="news-related-itm">
                                    <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- END: News related-->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>