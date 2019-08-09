<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OrderDetails */

$this->title = 'Create Order Details';
$this->params['breadcrumbs'][] = ['label' => 'Order Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-details-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
