<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tag */

$this->title = 'Cập nhật nhãn: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nhãn', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="tag-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
