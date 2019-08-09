<?php
$this->title='Blog';
?>

<?php if ($blog): ?>
    <section class="main">
        <div class="main-content">
            <?php if ($slider): ?>
                <div class="main-slider">
                    <div class="main-slider-inner">
                        <?php foreach ($slider as $item):
                            /**@var $item common\models\Slider*/
                            ?>
                            <div class="main-slider-itm"><img src="<?php echo $item->fullPathImageThumbnail?>" alt="<?php $item->title ?>"></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- END: Main slider-->
            <div class="news-content">
                <div class="container-fluid">
                    <div class="news-list">
                        <div class="news-list-inner">
                            <div class="row">
                                <?php foreach ($blog as $item):
                                    /** @var $new common\models\Article */
                                    ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12"><a href="/article/<?php echo $item->slug?>" class="news-itm">
                                            <div class="news-img" style="overflow: hidden"><img src="<?php echo $item->fullPathImageThumbnail?>"  > </div>
                                            <div class="news-ttl">
                                                <h3><?php echo $item->title?></h3>
                                            </div>
                                            <div class="news-short-desc">
                                                <p><?php echo substr($item->description, 0, 120)?></p>
                                            </div></a></div>
                                    <!-- END: News item-->
                                <?php endforeach; ?>
                            </div>
                            <div class="paging-blk">
                                <form method="post">
                                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="page-numb"><span>Trang <?=$page+1?>/<?=$total_page?></span></div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="paging-btn-blk text-right">
                                                <button name="action" value="prev" class="prev-btn paging-btn <?=($page+1<=1 ? 'disabled' : '')?>"><i class="fa fa-angle-left"></i></button>
                                                <button name="action" value="next" class="next-btn paging-btn <?=($page+1>=$total_page ? 'disabled' : '')?>"><i class="fa fa-angle-right"></i></button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="page" value="<?=$page?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else:?>
    <section class="main">
        <div class="main-content">
            <div class="news-content">
                <div class="container-fluid">
                    <div class="blk-ttl">
                        <h3>Tin tức</h3>
                    </div>
                    <div class="news-list">
                        <div class="news-list-inner">
                            <h3>Dữ liệu đang được cập nhật...</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


