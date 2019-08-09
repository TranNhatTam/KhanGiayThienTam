<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OrderDetails */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-details-view">

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
            'product_code',
            'product_image',
            'product_ref',
            'unit_price',
            'quantity',
            'tax_value',
            'discount',
            'weight',
            'category_id',
            'extra_number',
            'extra_percent',
            'extra_lbs',
            'total_price',
            'note:ntext',
            'tracking_status',
            'order_date',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
