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
            'label' => 'Mã sản phẩm'
        ],
        'label',
        [
            'attribute' => 'price',
            'label' => 'Đơn Giá'
        ],
        [
            'attribute' => 'quantity',
            'label' => 'Số Lượng'
        ],
        [
            'attribute' => 'totalPrice',
            'label' => 'Thành tiền'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'options' => ['style' => 'width: 5%'],
            'template' => '{delete}',
            'buttons' => [
                    'delete' => function ($url,$model) {
                    return Html::button(
                        '<span class="fa fa-minus-circle" style="color: red"></span> Xóa',
                        [
                            'title' => 'Remove','data-id' => $model->getUniqueId(),'class'=>'btn btn-rm-cartitem','onclick'=>'RemoveProductCart('.$model->getUniqueId().')'
                        ]
                    );
                },
            ],
        ],
    ]
]);
?>

