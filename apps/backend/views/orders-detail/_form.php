<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrdersDetail */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="orders-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'order_id')->textInput() ?>

    <?php echo $form->field($model, 'product_id')->textInput() ?>

    <?php echo $form->field($model, 'unit_price')->textInput() ?>

    <?php echo $form->field($model, 'quantity')->textInput() ?>

    <?php echo $form->field($model, 'tax_value')->textInput() ?>

    <?php echo $form->field($model, 'discount')->textInput() ?>

    <?php echo $form->field($model, 'total_price')->textInput() ?>

    <?php echo $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'created_at')->textInput() ?>

    <?php echo $form->field($model, 'updated_at')->textInput() ?>

    <?php echo $form->field($model, 'is_deleted')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
