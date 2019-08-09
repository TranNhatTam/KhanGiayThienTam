<?php

use dosamigos\tinymce\TinyMce;
use kartik\select2\Select2;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <h3>Thông tin</h3>
                </div>
                <div class="box-body" style="margin-left: 20px">
                    <?php echo $form->field($model, 'name')->textInput(['id'=>'product-name','onkeyup'=>'ChangeToSlug();'])->label('Tên sản phẩm') ?>

                    <?php echo $form->field($model, 'code')->textInput()->label('Mã sản phẩm') ?>

                    <?php echo $form->field($model, 'description')->widget(TinyMce::className(), [
                        'options' => ['rows' => 6],
                        'language' => 'vi',
                        'clientOptions' => [
                            'plugins' => [
                                "advlist autolink lists link charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste image"
                            ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code image"
                        ]
                    ])->label('Mô tả') ?>

                    <?php echo $form->field($model, 'short_detail')->textInput()->label('Trích dẫn') ?>

                    <?php echo $form->field($model, 'priority')->textInput() ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header">
                    <h3>Hình ảnh</h3>
                </div>
                <div class="box-body" style="margin-left: 20px">
                    <?php echo $form->field($model, 'thumbnail')->widget(
                        Upload::class,
                        [
                            'url' => ['/file/storage/upload'],
                            'maxFileSize' => 5000000, // 5 MiB
                        ]);
                    ?>
                    <?php echo $form->field($model, 'attachments')->widget(
                        Upload::class,
                        [
                            'url' => ['/file/storage/upload'],
                            'sortable' => true,
                            'maxFileSize' => 10000000, // 10 MiB
                            'maxNumberOfFiles' => 10,
                        ])->label('Đính kèm');
                    ?>
                </div>

            </div>

            <div class="box">
                <div class="box-header">
                    <h3>Giá sản phẩm</h3>
                </div>
                <div class="box-body" style="margin-left: 20px">
                    <?php echo $form->field($model, 'unit_price')->textInput()->label('Giá') ?>

                    <?php echo $form->field($model, 'discount')->textInput()->label('Giá giảm') ?>

                    <?php echo $form->field($model, 'weight')->textInput(['placeholder'=>'gram'])->label('Khối lượng') ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header">
                    <h3>Kho</h3>
                </div>
                <div class="box-body" style="margin-left: 20px">
                    <?php echo $form->field($model, 'unit_in_stock')->textInput() ?>

                    <?php echo $form->field($model, 'quantity_in_stock')->textInput() ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header">
                    <h3>Tối ưu SEO</h3>
                    <p>Thiết lập các thẻ mô tả giúp khách hàng dễ dàng tìm thấy sản phẩm trên công cụ tìm kiếm như Google.</p>
                </div>
                <div class="box-body" style="margin-left: 20px">
                    <?php echo $form->field($modelUrls,'title')->textInput() ?>

                    <?php echo $form->field($modelUrls,'description')->textarea(['rows' => 4]) ?>

                    <?php echo $form->field($modelUrls,'route',[
                        'inputTemplate' => '<div class="input-group"><span class="input-group-addon" style="border-right: none; color: lightgrey">http://demo.com/product/</span>{input}</div>'
                    ])->textInput(['style'=>'border-left: none','id'=>'slug']) ?>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3>Phân loại</h3>
                </div>
                <div class="box-body" style="margin-left: 20px">
                    <?php
                        $c_id = Yii::$app->request->get('c_id');
                        if (isset($c_id)) {
                            $model->category_id = $c_id;
                            echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Category::find()->all(),'id','name'))->label('Loại sản phẩm');
                        } else {
                            echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Category::find()->all(),'id','name'))->label('Loại sản phẩm');
                        }

                    ?>

                    <?php echo $form->field($model, 'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Brand::find()->all(),'id','name'))->label('Nhà sản xuất') ?>

                    <?php
                    echo $form->field($model,'tags')->widget(Select2::className(),[
                        'data' => \yii\helpers\ArrayHelper::map(\common\models\Tag::find()->all(),'name','name'),
                        'options' => ['placeholder' => 'Chọn nhãn ...', 'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tags' => true,
                            'tokenSeparators' => [','],
                            'maximumInputLength' => 10
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>







    <?php //echo $form->field($model, 'discount')->textInput() ?>

    <?php // echo $form->field($model, 'star_rating')->textInput() ?>

    <?php //echo $form->field($model, 'total_view')->textInput() ?>

    <?php //echo $form->field($model, 'status')->textInput(['maxlength' => true]) ?>





    <?php //echo $form->field($model, 'warranty')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'group_id')->textInput() ?>

    <?php //echo $form->field($model, 'technical_detail')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'additional_detail')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'unit_in_stock')->textInput() ?>

    <?php //echo $form->field($model, 'quantity_in_stock')->textInput() ?>

    <?php //echo $form->field($model, 'suppiler_id')->textInput() ?>

    <?php //echo $form->field($model, 'product_ref')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::a('Hủy','/product/index',['class'=>'btn btn-default'])?>
        <?php echo Html::submitButton($model->isNewRecord ? 'Thêm' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>

    function ChangeToSlug()
    {
        var title, slug;

        //Lấy text từ thẻ input title
        title = document.getElementById("product-name").value;

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('slug').value = slug;
    }
</script>