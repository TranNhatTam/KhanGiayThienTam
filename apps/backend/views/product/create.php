<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $modelUrl common\models\Url */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'modelUrl' => $modelUrl,
    ]) ?>

</div>
