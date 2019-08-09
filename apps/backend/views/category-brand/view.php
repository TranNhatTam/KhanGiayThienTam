<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryBrand */

$this->title = $model->category_id;
$this->params['breadcrumbs'][] = ['label' => 'Category Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-brand-view">

    <p>
        <?php echo Html::a('Update', ['update', 'category_id' => $model->category_id, 'brand_id' => $model->brand_id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'category_id' => $model->category_id, 'brand_id' => $model->brand_id], [
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
            'category_id',
            'brand_id',
        ],
    ]) ?>

</div>
