<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:html',
            [
                'format' => 'raw',
                'label' => 'Nhà sản xuất',
                'value' => function($model){
                    $categoryBrand = \common\models\CategoryBrand::find()->where(['category_id'=>$model->id])->all();
                    $string  = '';
                    foreach ($categoryBrand as $item){
                        $brand = \common\models\Brand::find()->where(['id'=>$item->brand_id])->one();
                        if ($brand){
                            $string =  $string.' <span style="background: #0d6aad;color: #fff;padding: 5px;border-radius: 5px">'.$brand->name.'</span>';
                        }
                    }
                    return $string;
                }
            ],
        ],
    ]) ?>

</div>
