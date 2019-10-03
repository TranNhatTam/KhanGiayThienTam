<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OrdersDetail */

$this->title = 'Update Orders Detail: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orders-detail-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
