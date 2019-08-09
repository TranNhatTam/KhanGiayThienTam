<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BrandSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="brand-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'name',[
        'template' => '{label} {input}{error}{hint}',
        'options' => ['class' => 'form-group form-inline'],
    ])->textInput(['placeholder'=>'Nhập tên nhóm sản phẩm'])->label('Tìm kiếm:') ?>

    <?php ActiveForm::end(); ?>

</div>