<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryBrand */

$this->title = 'Update Category Brand: ' . ' ' . $model->category_id;
$this->params['breadcrumbs'][] = ['label' => 'Category Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->category_id, 'url' => ['view', 'category_id' => $model->category_id, 'brand_id' => $model->brand_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-brand-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories'=>$categories,
        'brands'=>$brands,
    ]) ?>

</div>
