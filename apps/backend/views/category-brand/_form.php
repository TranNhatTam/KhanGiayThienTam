<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryBrand */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="category-brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        $categories,
        'id',
        'name'
    ), ['prompt' => '']) ?>

    <?php echo $form->field($model, 'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        $brands,
        'id',
        'name'
    ), ['prompt' => '']) ?>


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
