<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = 'Cập nhập sản phẩm: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Danh sách sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Cập nhập';
?>
<div class="product-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'modelUrls' => $modelUrls,
    ]) ?>

</div>
