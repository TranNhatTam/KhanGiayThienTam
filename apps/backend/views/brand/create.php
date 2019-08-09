<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Brand */

$this->title = 'Thêm Nhà sản xuất';
$this->params['breadcrumbs'][] = ['label' => 'Nhà sản xuất', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
