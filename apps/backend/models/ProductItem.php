<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/10/2018
 * Time: 6:19 PM
 */

namespace backend\models;


use common\models\Product;
use yii2mod\cart\models\CartItemInterface;

class ProductItem extends Product implements CartItemInterface
{

    public $quantity;
    public $total_price;

    /**
     * Returns the price for the cart item
     *
     * @return int
     */
    public function getPrice(): int
    {
        return $this->unit_price;
        // TODO: Implement getPrice() method.
    }

    /**
     * Returns the label for the cart item (displayed in cart etc)
     *
     * @return int|string
     */
    public function getLabel()
    {
        return $this->name;
        // TODO: Implement getLabel() method.
    }

    /**
     * Returns unique id to associate cart item with product
     *
     * @return int|string
     */
    public function getUniqueId()
    {
        return $this->id;
        // TODO: Implement getUniqueId() method.
    }

    public function getCode()
    {
        return $this->code;
        // TODO: Implement getUniqueId() method.
    }
}