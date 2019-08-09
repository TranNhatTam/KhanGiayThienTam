<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_details".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $product_code
 * @property string $product_image
 * @property string $product_ref
 * @property double $unit_price
 * @property int $quantity
 * @property double $tax_value
 * @property double $discount
 * @property double $weight
 * @property int $category_id
 * @property double $extra_number
 * @property double $extra_percent
 * @property double $extra_lbs
 * @property double $total_price
 * @property string $note
 * @property string $tracking_status
 * @property string $order_date
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 */
class OrderDetails extends ActiveRecord
{

    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'unit_price', 'quantity', 'tax_value', 'discount'], 'required'],
            [['order_id', 'product_id', 'quantity', 'category_id'], 'integer'],
            [['unit_price', 'tax_value', 'discount', 'weight', 'extra_number', 'extra_percent', 'extra_lbs', 'total_price'], 'number'],
            [['note'], 'string'],
            [['order_date', 'created_at', 'updated_at'], 'safe'],
            [['product_code', 'product_image', 'product_ref', 'tracking_status', 'status'], 'string', 'max' => 255],
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
            'product_code' => 'Product Code',
            'product_image' => 'Product Image',
            'product_ref' => 'Product Ref',
            'unit_price' => 'Giá sản phẩm',
            'quantity' => 'Số lượng',
            'tax_value' => 'Tax Value',
            'discount' => 'Discount',
            'weight' => 'Weight',
            'category_id' => 'Category ID',
            'extra_number' => 'Extra Number',
            'extra_percent' => 'Extra Percent',
            'extra_lbs' => 'Extra Lbs',
            'total_price' => 'Giá',
            'note' => 'Note',
            'tracking_status' => 'Tracking Status',
            'order_date' => 'Order Date',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'product.name' => 'Tên sản phẩm',
            'product.code' => 'Mã sản phẩm'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(),['id'=>'product_id']);
    }
}
