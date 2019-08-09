<?php

use dosamigos\tinymce\TinyMce;
use kartik\select2\Select2;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\bootstrap\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="box">
    <div class="box-body">
        <div class="category-form">

            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'category-name', 'onkeyup' => 'ChangeToSlug();']) ?>

            <?php echo $form->field($model, 'group_id')->dropDownList([Category::GROUP_BESTSELLER => "Bán chạy nhất", Category::GROUP_PROMOTION => "Khuyến mãi", Category::GROUP_NORMAL => "Thường"])->label('Loại') ?>

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

            <?php echo $form->field($model, 'priority')->textInput(['maxlength' => true]) ?>

            <?php
            echo $form->field($model, 'brands')->widget(Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Brand::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Chọn nhà sản xuất ...', 'multiple' => true],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
            ?>

            <?php echo $form->field($model, 'is_show')->checkbox()->label('Hiển thị ra màn hình trang chủ') ?>

            <?php echo $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
</div>
<div class="box">
    <div class="box-header">
        <h3>Tối ưu SEO</h3>
        <p>Thiết lập các thẻ mô tả giúp khách hàng dễ dàng tìm thấy sản phẩm trên công cụ tìm kiếm như Google.</p>
    </div>
    <div class="box-body" style="margin-left: 20px">
        <?php echo $form->field($modelUrls, 'title')->textInput() ?>

        <?php echo $form->field($modelUrls, 'description')->textarea(['rows' => 4]) ?>

        <?php echo $form->field($modelUrls, 'route', [
            'inputTemplate' => '<div class="input-group"><span class="input-group-addon" style="border-right: none; color: lightgrey">http://demo.com/category/</span>{input}</div>'
        ])->textInput(['style' => 'border-left: none', 'id' => 'slug']) ?>
    </div>
</div>
<?php
if (!$model->isNewRecord) {
    $c_id = $model->id;
    ?>

    <div class="box">
        <div class="box-header">
            <h3>Danh sách sản phẩm</h3>
            <a href="/product/create?c_id=<?=$model->id?>" class="btn btn-success"><i class="fa fa-plus"></i> Tạo sản phẩm mới</a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Thêm sản phẩm đã xóa</button>
        </div>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-error alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        <div class="box-body">
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => 'Hiển thị <b>{begin}</b>-<b>{end}</b> trong <b>{totalCount}</b> nhóm sản phẩm',
                'columns' => [
                    [
                        'format' => 'raw',
                        'contentOptions' => ['class' => 'text-center'],
                        'value' => function ($model) {
                            if ($model->thumbnail_base_url == null) {
                                return '<img src="/img/default.jpg" width="50">';
                            }
                            return '<img src="' . $model->thumbnail_base_url . '/' . $model->thumbnail_path . '" width="50">';
                        }
                    ],
                    [
                        'attribute' => 'name',
                        'value' => function ($model) {
                            return Html::a($model->name, ['product/update', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    'priority',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'text-center'],
                        'options' => ['style' => 'width: 5%'],
                        'template' => '{remove}',
                        'buttons' => [
                            'remove' => function ($url, $model) use ($c_id) {
                                $url = str_replace('category', 'product', $url);
                                return Html::a(
                                    '<span class="fa fa-trash"></span>',
                                    ['category/remove-product', 'p_id' => $model->id, 'c_id' => $c_id],
                                    [
                                        'title' => 'Gỡ bỏ',
                                        'data-pjax' => '0',
                                    ]
                                );
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>

    </div>
    <?php
}
?>

<div class="form-group">
    <?php echo Html::submitButton($model->isNewRecord ? 'Thêm' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Danh sách sản phẩm</h4>
            </div>
            <form action="/category/add-product" method="post">
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <input type="hidden" name="CategoryID" value="<?=$model->id?>" />
                    <?php
                    $products = \common\models\Product::find()->where(['category_id' => 0])->all();
                    if (count($products) == 0) {
                        echo '<span style="padding-left: 20px">Không có sản phẩm để hiển thị</span>';
                    } else {
                        foreach ($products as $itemProduct) {
                            ?>
                            <div class="col-md-6">
                                <label for="product-<?= $itemProduct->id ?>">
                                    <input type="checkbox" value="<?= $itemProduct->id ?>" id="product-<?= $itemProduct->id ?>" name="ProductID[]">
                                    <?php
                                    if ($itemProduct->thumbnail_base_url == null) {
                                        echo '<img src="/img/default.jpg" width="50">';
                                    }
                                    echo '<img src="' . $itemProduct->thumbnail_base_url . '/' . $itemProduct->thumbnail_path . '" width="50">';
                                    ?>
                                    <?= $itemProduct->name ?>
                                </label>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <?php
                if (count($products) != 0) {
                    echo '<button type="submit" class="btn btn-success pull-left">Lưu</button>';
                }
                ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>

            </div>
            </form>
        </div>

    </div>
</div>


