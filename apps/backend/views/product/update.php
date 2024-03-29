<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $modelUrl common\models\Url */

$this->title = 'Update Product: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'modelUrl' => $modelUrl,
    ]) ?>

</div>
