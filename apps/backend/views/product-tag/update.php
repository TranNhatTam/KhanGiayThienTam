<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductTag */

$this->title = 'Update Product Tag: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-tag-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
