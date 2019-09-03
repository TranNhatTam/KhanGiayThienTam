<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/18/2018
 * Time: 2:37 AM
 */

namespace frontend\models;

use common\models\Product;
use yii2mod\cart\models\CartItemInterface;

class CartItem extends Product implements CartItemInterface
{
    /**
     * Returns the label for the cart item (displayed in cart etc)
     *
     * @return int|string
     */
    public function getLabel()
    {
        return $this->name;
    }

    /**
     * Returns unique id to associate cart item with product
     *
     * @return int|string
     */
    public function getUniqueId()
    {
        return $this->id;
    }

    /**
     * Returns the price for the cart item
     *
     * @return int
     */
    public function getPrice(): int
    {
        return $this->unit_price;
    }
}