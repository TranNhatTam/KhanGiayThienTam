<?php

use common\models\Posts;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'thumbnail')->widget(\trntv\filekit\widget\Upload::class, [
        'url' => ['thumbnail-upload']
    ]) ?>

    <?php echo $form->field($model, 'content')->widget(TinyMce::className(), [
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

    <?php echo $form->field($model, 'type')->dropDownList(Posts::types()) ?>

    <?php echo $form->field($model, 'status')->dropDownList(Posts::statues()) ?>

    <?php echo $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
