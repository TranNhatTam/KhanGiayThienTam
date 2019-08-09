<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Thêm nhóm sản phảm';
$this->params['breadcrumbs'][] = ['label' => 'Nhóm sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'modelUrls' => $modelUrls,
    ]) ?>

</div>
