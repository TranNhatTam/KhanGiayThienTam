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
            'id',
            'name',
            'thumbnail_path',
            'thumbnail_base_url:url',
            'unit_price',
            'unit_in_stock',
            'quantity_in_stock',
            'discount',
            'star_rating',
            'total_view',
            'warranty',
            'short_detail:ntext',
            'description:ntext',
            'technical_detail:ntext',
            'additional_detail:ntext',
            'status',
            'priority',
            'created_at',
            'updated_at',
            'is_deleted',
            'brand_id',
            'category_id',
            'url_id:url',
            'images:ntext',
        ],
    ]) ?>

</div>
