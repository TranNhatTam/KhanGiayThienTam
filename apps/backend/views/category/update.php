<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Cập nhập nhóm sản phẩm: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nhóm sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Cập nhập';
?>
<div class="category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'modelUrls' => $modelUrls,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
