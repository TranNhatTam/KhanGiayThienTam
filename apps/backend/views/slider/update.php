<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */

$this->title = 'Update Slider: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sliders', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="slider-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
