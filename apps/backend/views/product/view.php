<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

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
            //'id',
            'name',
            'category.name',
            'brand.name',
            'unit_price',
            //'discount',
            //'star_rating',
            //'total_view',
            //'status',
            'description:html',
            'short_detail',
            //'warranty',
            //'group_id',
            //'technical_detail:ntext',
            //'additional_detail',
            'unit_in_stock',
            'quantity_in_stock',
            //'suppiler_id',
            //'product_ref',
        ],
    ]) ?>

</div>
