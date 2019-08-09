<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Brand */

$this->title = 'Cập nhật Nhà sản xuất: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nhà sản xuất', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="brand-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
