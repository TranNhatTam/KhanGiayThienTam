<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ContactFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-form-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Contact Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'phone',
            'email:email',
            'subject',
            // 'body',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
