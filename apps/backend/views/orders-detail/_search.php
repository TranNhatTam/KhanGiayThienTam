<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\OrdersDetailSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="orders-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'order_id') ?>

    <?php echo $form->field($model, 'product_id') ?>

    <?php echo $form->field($model, 'unit_price') ?>

    <?php echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'tax_value') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
