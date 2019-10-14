<?php
$this->title='Tin Tức';
?>

<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <!-- Posts
            ============================================= -->
            <div id="posts" class="post-grid grid-container clearfix" data-layout="fitRows">
                <?php foreach ($model as $item) { ?>
                <div class="entry clearfix">
                    <div class="entry-image">
                        <a href="images/blog/full/17.jpg" data-lightbox="image"><img class="image_fade" src="/images/blog/grid/17.jpg" alt="Standard Post with Image"></a>
                    </div>
                    <div class="entry-title">
                        <h2><a href="blog-single.html">This is a Standard post with a Preview Image</a></h2>
                    </div>
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i> 10th Feb 2014</li>
                        <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
                        <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                    </ul>
                    <div class="entry-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, voluptatem, dolorem animi nisi autem blanditiis enim culpa reiciendis et explicabo tenetur!</p>
                        <a href="blog-single.html"class="more-link">Read More</a>
                    </div>
                </div>
                <?php } ?>
            </div><!-- #posts end -->
        </div>

    </div>

</section><!-- #content end -->


