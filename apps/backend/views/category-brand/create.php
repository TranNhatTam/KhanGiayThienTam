<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CategoryBrand */

$this->title = 'Create Category Brand';
$this->params['breadcrumbs'][] = ['label' => 'Category Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-brand-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories'=>$categories,
        'brands'=>$brands,
    ]) ?>

</div>
