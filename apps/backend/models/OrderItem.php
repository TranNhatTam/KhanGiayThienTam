<?php
/**
 * Created by PhpStorm.
 * User: xfire
 * Date: 11/10/2018
 * Time: 4:40 PM
 */

namespace backend\models;


use common\models\OrderDetail;
use yii2mod\cart\models\CartItemInterface;

class OrderItem extends OrderDetail implements CartItemInterface
{
    /**
     * Returns the price for the cart item
     *
     * @return int
     */
    public function getPrice(): int
    {
        return $this->product->unit_price;
        // TODO: Implement getPrice() method.
    }

    /**
     * Returns the label for the cart item (displayed in cart etc)
     *
     * @return int|string
     */
    public function getLabel()
    {
        return $this->product->name;
        // TODO: Implement getLabel() method.
    }

    /**
     * Returns unique id to associate cart item with product
     *
     * @return int|string
     */
    public function getUniqueId()
    {
        return $this->product_id;
        // TODO: Implement getUniqueId() method.
    }

    public function getProductCode()
    {
        return $this->product->code;
    }

    public function getTotalPrice()
    {
        $this->total_price = $this->quantity * $this->getPrice();
        return $this->total_price;
    }
}