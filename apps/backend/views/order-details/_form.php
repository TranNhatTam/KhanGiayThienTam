<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrderDetails */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="order-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'order_id')->textInput() ?>

    <?php echo $form->field($model, 'product_id')->textInput() ?>

    <?php echo $form->field($model, 'product_code')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'product_image')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'product_ref')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'unit_price')->textInput() ?>

    <?php echo $form->field($model, 'quantity')->textInput() ?>

    <?php echo $form->field($model, 'tax_value')->textInput() ?>

    <?php echo $form->field($model, 'discount')->textInput() ?>

    <?php echo $form->field($model, 'weight')->textInput() ?>

    <?php echo $form->field($model, 'category_id')->textInput() ?>

    <?php echo $form->field($model, 'extra_number')->textInput() ?>

    <?php echo $form->field($model, 'extra_percent')->textInput() ?>

    <?php echo $form->field($model, 'extra_lbs')->textInput() ?>

    <?php echo $form->field($model, 'total_price')->textInput() ?>

    <?php echo $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'tracking_status')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'order_date')->textInput() ?>

    <?php echo $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'created_at')->textInput() ?>

    <?php echo $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
