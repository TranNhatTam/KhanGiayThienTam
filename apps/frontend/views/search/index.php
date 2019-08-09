<?php

/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/16/2018
 * Time: 2:08 PM
 */

/* @var $this \yii\web\View */
/* @var $categories array|\common\models\Brand[]|\common\models\Category[]|\yii\db\ActiveRecord[] */
/* @var $brands array|\common\models\Brand[]|\common\models\Category[]|\yii\db\ActiveRecord[] */
$this->title = 'Danh sách sản phẩm'
?>
    <section class="main">
        <div class="main-content">
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
                                                    <li><a href="/<?=$category->urls->route?>" data-id="<?=$category->id?>"
                                                           class="filt-itm"><span><?php echo $category->name ?></span></a>
                                                    </li>
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
                                            <input type="text" placeholder="Tên thương hiệu" class="brand-search-txt">
                                            <button><i class="fa fa-search"></i></button>
                                        </div>
                                        <div class="filt-list brand-list">
                                            <?=$this->renderAjax('/product/list-brand',['brands'=>$brands])?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- END: Category-->
                        <div class="col-md-9 col-xs-12">
                            <div class="product-list-inner">
                                <?php
                                echo $this->renderAjax('/product/list', ['product' => $product,'pages'=>$pages])
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
$js = <<<JS
$("input[type=checkbox]").on("change", function(){
        var arr = []
        $(":checkbox").each(function(){
            if($(this).is(":checked")){
                arr.push($(this).val())
            }
        })
        // var vals = arr.join(",")
        // var brand = "brand=" + vals
        $.ajax({
            'url':'/product/sort-product-by-brand',
            'method':'GET',
            'data':{
              'brand':arr  
            },
            'success': function(data) {
                $('.product-list-inner').html(data.data)
            }
        })
        
        // var str = "http://example.com/?subject=Products&checked=" + vals
        // console.log(str);
        //
        // if (vals.length > 0) {
        //     $('.link').html($('<a>', {
        //         href: str,
        //         text: str
        //     }));
        // } else {
        //     $('.link').html('');
        // }
    });
$('.filt-itm').click(function() {
    var category_id = $(this).attr('data-id')
    $.ajax({
            'url':'/product/sort-product-by-category',
            'method':'GET',
            'data':{
              'category':category_id  
            },
            'success': function(data) {
                $('.product-list-inner').html(data.data)
            }
        })
});
$('.brand-search-txt').keyup(function() {
  var value = $(this).val()
 $.ajax({
    'url':'/product/search-brand',
    'method':'GET',
    'data':{
        'name':value
    },
    'success': function(data) {
        $('.brand-list').html(data.data)
    }
 })
})
JS;
$this->registerJs($js)
?>