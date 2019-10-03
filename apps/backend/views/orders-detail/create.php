<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OrdersDetail */

$this->title = 'Create Orders Detail';
$this->params['breadcrumbs'][] = ['label' => 'Orders Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-detail-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
