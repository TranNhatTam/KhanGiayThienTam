<?php

use dosamigos\tinymce\TinyMce;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Brand */
/* @var $modelUrl common\models\Url */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="brand-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="box">
        <div class="box-header">
            <h3>Information</h3>
        </div>
        <div class="box-body">
            <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

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
