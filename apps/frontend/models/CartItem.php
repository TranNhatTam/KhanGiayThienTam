<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/18/2018
 * Time: 2:37 AM
 */

namespace frontend\models;

use common\models\Product;
use dtsmart\cart\ItemInterface;
use dtsmart\cart\ItemTrait;
use yii\db\ActiveRecord;

class CartItem extends Product implements ItemInterface
{
    use ItemTrait;

    public function getPrice()
    {
        return $this->unit_price;
    }

    public function getId()
    {
        return $this->id;
    }

}