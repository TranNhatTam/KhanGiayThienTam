<?php

/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/10/2018
 * Time: 1:14 AM
 */

use kartik\select2\Select2;
use yii\helpers\Html;

/* @var $this \yii\web\View */

?>
<?php echo \yii2mod\cart\widgets\CartGrid::widget([
    // Some widget property maybe need to change.
    'cartColumns' => [
        [
            'attribute' => 'productCode',
            'label' => 'Product Code'
        ],
        [
            'attribute' => 'label',
            'header' => 'Product Name'
        ],
        [
            'attribute' => 'price',
            'label' => 'Price'
        ],
        [
            'attribute' => 'quantity',
            'label' => 'Quantity'
        ],
        [
            'attribute' => 'totalPrice',
            'label' => 'Total Price'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'options' => ['style' => 'width: 5%'],
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::button(
                        '<span class="fa fa-minus-circle" style="color: red"></span> Remove',
                        [
                            'title' => 'Remove', 'data-id' => $model->uniqueId, 'class' => 'btn btn-rm-cartitem', 'onclick' => 'RemoveProductCart(' . $model->uniqueId . ')'
                        ]
                    );
                },
            ],
        ],
    ]
]);
?>

