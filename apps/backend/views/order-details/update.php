<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OrderDetails */

$this->title = 'Update Order Details: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-details-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
