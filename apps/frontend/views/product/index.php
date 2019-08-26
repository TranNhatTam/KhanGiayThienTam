<?php

/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/16/2018
 * Time: 2:08 PM
 */

/* @var $this \yii\web\View */
/* @var $product array|\common\models\Product[]|\yii\db\ActiveRecord[] */
$this->title = 'Danh sách sản phẩm'
?>
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="postcontent nobottommargin col_last">
                    <div id="shop" class="shop product-3 grid-container clearfix">
                        <?php
                        echo $this->renderAjax('_item', ['product' => $product])
                        ?>
                    </div>
                </div>

                <div class="sidebar nobottommargin">
                    <div class="sidebar-widgets-wrap">
                        <div class="widget widget-filter-links clearfix">
                            <h4>Select Category</h4>
                            <ul class="custom-filter" data-container="#shop" data-active-class="active-filter">
                                <li class="widget-filter-reset active-filter"><a href="#" data-filter="*">Clear</a></li>
                                <li><a href="#" data-filter=".sf-dress">Dress</a></li>
                                <li><a href="#" data-filter=".sf-tshirt">Tshirts</a></li>
                                <li><a href="#" data-filter=".sf-pant">Pants</a></li>
                                <li><a href="#" data-filter=".sf-sunglass">Sunglasses</a></li>
                                <li><a href="#" data-filter=".sf-shoes">Shoes</a></li>
                                <li><a href="#" data-filter=".sf-watch">Watches</a></li>
                            </ul>

                        </div>
                        <div class="widget widget-filter-links clearfix">
                            <h4>Sort By</h4>
                            <ul class="shop-sorting">
                                <li class="widget-filter-reset active-filter"><a href="#" data-sort-by="original-order">Clear</a>
                                </li>
                                <li><a href="#" data-sort-by="name">Name</a></li>
                                <li><a href="#" data-sort-by="price_lh">Price: Low to High</a></li>
                                <li><a href="#" data-sort-by="price_hl">Price: High to Low</a></li>
                            </ul>
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