<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Business */

$this->title = 'Cập nhật:  ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Công ty', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="business-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
