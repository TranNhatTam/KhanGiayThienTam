<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OrdersDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-detail-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_id',
            'product_id',
            'unit_price',
            'quantity',
            'tax_value',
            'discount',
            'total_price',
            'note:ntext',
            'created_at',
            'updated_at',
            'is_deleted',
        ],
    ]) ?>

</div>
