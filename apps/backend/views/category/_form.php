<?php

use dosamigos\tinymce\TinyMce;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $modelUrl common\models\Url */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="box">
        <div class="box-header">
            <h3>Information</h3>
        </div>
        <div class="box-body">
            <?php echo $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'category-name', 'onkeyup' => 'ChangeToSlug();']) ?>

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
            ]) ?>

            <?php echo $form->field($model, 'thumbnail')->widget(
                Upload::class,
                [
                    'url' => ['/file/storage/upload'],
                    'maxFileSize' => 5000000, // 5 MiB
                ]);
            ?>

            <?php echo $form->field($model, 'priority')->textInput() ?>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3>SEO</h3>
        </div>
        <div class="box-body">
            <?php echo $form->field($modelUrl, 'title')->textInput() ?>

            <?php echo $form->field($modelUrl, 'description')->textarea(['rows' => 4]) ?>

            <?php echo $form->field($modelUrl, 'route', [
                'inputTemplate' => '<div class="input-group"><span class="input-group-addon" style="border-right: none; color: lightgrey">http://demo.com/category/</span>{input}</div>'
            ])->textInput(['style' => 'border-left: none', 'id' => 'slug']) ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function ChangeToSlug() {
        var title, slug;

        //Lấy text từ thẻ input title
        title = document.getElementById("category-name").value;

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
