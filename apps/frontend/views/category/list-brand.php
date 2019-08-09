<?php

/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/17/2018
 * Time: 2:16 PM
 */

/* @var $this \yii\web\View */
/* @var $brands array|\common\models\Brand[]|\common\models\Category[]|\yii\db\ActiveRecord[] */
/* @var $brand \common\models\Brand */
?>
<?php $count = 1;
foreach ($brands as $brand): ?>
    <div class="cus-chk">
        <input id="chk<?= $count ?>" type="checkbox"
               value="<?= $brand->id ?>">
        <label for="chk<?= $count ?>"><span><?php echo $brand->name;
                $count++ ?></span></label>
    </div>
<?php endforeach; ?>
