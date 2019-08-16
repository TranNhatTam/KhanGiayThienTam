<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property double $unit_price
 * @property int $quantity
 * @property double $tax_value
 * @property double $discount
 * @property double $total_price
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'unit_price', 'quantity', 'tax_value', 'discount', 'total_price'], 'required'],
            [['order_id', 'product_id', 'quantity', 'is_deleted'], 'integer'],
            [['unit_price', 'tax_value', 'discount', 'total_price'], 'number'],
            [['note'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'unit_price' => 'Unit Price',
            'quantity' => 'Quantity',
            'tax_value' => 'Tax Value',
            'discount' => 'Discount',
            'total_price' => 'Total Price',
            'note' => 'Note',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
