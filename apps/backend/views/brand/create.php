<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Brand */
/* @var $modelUrl common\models\Url */

$this->title = 'Create Brand';
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'modelUrl' => $modelUrl,
    ]) ?>

</div>
