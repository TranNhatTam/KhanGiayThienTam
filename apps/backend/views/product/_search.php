<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'name',[
            'template' => '{label} {input}{error}{hint}',
            'options' => ['class' => 'form-group form-inline'],
        ])->textInput(['placeholder'=>'Nhập tên sản phẩm'])->label('Tìm kiếm:') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'brand_id') ?>

    <?php // echo $form->field($model, 'unit_price') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'star_rating') ?>

    <?php // echo $form->field($model, 'total_view') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'short_detail') ?>

    <?php // echo $form->field($model, 'warranty') ?>

    <?php // echo $form->field($model, 'group_id') ?>

    <?php // echo $form->field($model, 'technical_detail') ?>

    <?php // echo $form->field($model, 'additional_detail') ?>

    <?php // echo $form->field($model, 'unit_in_stock') ?>

    <?php // echo $form->field($model, 'quantity_in_stock') ?>

    <?php // echo $form->field($model, 'suppiler_id') ?>

    <?php // echo $form->field($model, 'product_ref') ?>

    <div class="form-group">
        <?php // echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php // echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
