<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderDetailsSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="order-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'order_id') ?>

    <?php echo $form->field($model, 'product_id') ?>

    <?php echo $form->field($model, 'product_code') ?>

    <?php echo $form->field($model, 'product_image') ?>

    <?php // echo $form->field($model, 'product_ref') ?>

    <?php // echo $form->field($model, 'unit_price') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'tax_value') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'extra_number') ?>

    <?php // echo $form->field($model, 'extra_percent') ?>

    <?php // echo $form->field($model, 'extra_lbs') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'tracking_status') ?>

    <?php // echo $form->field($model, 'order_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
