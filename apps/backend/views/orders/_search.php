<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrdersSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id',[
        'template' => '{label} {input}{error}{hint}',
        'options' => ['class' => 'form-group form-inline'],
    ])->textInput(['placeholder'=>'Nhập mã sản phẩm'])->label('Tìm kiếm:') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'employee_id') ?>

    <?php // echo $form->field($model, 'order_date') ?>

    <?php // echo $form->field($model, 'require_date') ?>

    <?php // echo $form->field($model, 'ship_date') ?>

    <?php // echo $form->field($model, 'shiper_id') ?>

    <?php // echo $form->field($model, 'freight') ?>

    <?php // echo $form->field($model, 'ship_name') ?>

    <?php // echo $form->field($model, 'ship_phone') ?>

    <?php // echo $form->field($model, 'ship_email') ?>

    <?php // echo $form->field($model, 'ship_address') ?>

    <?php // echo $form->field($model, 'ship_city') ?>

    <?php // echo $form->field($model, 'ship_district') ?>

    <?php // echo $form->field($model, 'ship_ward') ?>

    <?php // echo $form->field($model, 'ship_postalcode') ?>

    <?php // echo $form->field($model, 'ship_country') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'payment_type') ?>

    <?php // echo $form->field($model, 'notification_type') ?>

    <div class="form-group">
        <?php // echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php // echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
