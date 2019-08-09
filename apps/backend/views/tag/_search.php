<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TagSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="tag-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'name',[
        'template' => '{label} {input}{error}{hint}',
        'options' => ['class' => 'form-group form-inline'],
    ])->textInput(['placeholder'=>'Nhập nhãn'])->label('Tìm kiếm:') ?>

    <?php ActiveForm::end(); ?>

</div>
