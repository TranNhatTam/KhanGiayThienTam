<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Address */

$this->title = 'Cập Nhật:  ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Địa chỉ', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="address-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
