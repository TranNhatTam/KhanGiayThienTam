<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactForm */

$this->title = 'Update Contact Form: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contact Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contact-form-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
