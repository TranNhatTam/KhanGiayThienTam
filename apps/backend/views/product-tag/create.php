<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductTag */

$this->title = 'Create Product Tag';
$this->params['breadcrumbs'][] = ['label' => 'Product Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-tag-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
