<?php

namespace common\models;

use Yii;
use yii2tech\ar\dynattribute\DynamicAttributeBehavior;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $employee_id
 * @property string $order_date
 * @property string $require_date
 * @property string $ship_date
 * @property int $shiper_id
 * @property double $freight
 * @property string $ship_name
 * @property string $ship_phone
 * @property string $ship_email
 * @property string $ship_address
 * @property string $ship_city
 * @property string $ship_district
 * @property string $ship_ward
 * @property string $ship_postalcode
 * @property string $ship_country
 * @property double $total_price
 * @property double $total_tax
 * @property string $status
 * @property string $note
 * @property string $fee_info
 * @property string $billing_info
 * @property string $payment_info
 * @property int $payment_type
 * @property int $notification_type
 * @property int $ship_status
 * @property int $payment_status
 * @property string $tax
 * @property string $ship
 * @property string $billing_address
 * @property string $type
 * @property string $description
 */
class Orders extends ActiveRecord
{
    const SHIP_STATUS_NOTDELIVERY = 0;
    const SHIP_STATUS_DELIVERED = 1;
    const PAYMENT_STATUS_NOTPAYING = 0;
    const PAYMENT_STATUS_PAID = 1;
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSED = 'processed';
    const STATUS_FINISHED = 'finished';
    const STATUS_CANCELLED = 'cancelled';

    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            'dynamicAttribute' => [
                'class' => DynamicAttributeBehavior::class,
                'storageAttribute' => 'fee_info', // field to store serialized attributes
                'dynamicAttributeDefaults' => [ // default values for the dynamic attributes
                    'tax' => '',
                    'ship' => '',
                ],
            ],
            'dynamicAttribute1' => [
                'class' => DynamicAttributeBehavior::class,
                'storageAttribute' => 'billing_info', // field to store serialized attributes
                'dynamicAttributeDefaults' => [ // default values for the dynamic attributes
                    'billing_address' => '',
                ],
            ],
            'dynamicAttribute2' => [
                'class' => DynamicAttributeBehavior::class,
                'storageAttribute' => 'payment_info', // field to store serialized attributes
                'dynamicAttributeDefaults' => [ // default values for the dynamic attributes
                    'type' => '',
                    'description' => '',
                ],
            ],
        ];
    }

    public $products;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'employee_id', 'shiper_id', 'payment_type', 'notification_type','ship_status','payment_status'], 'integer'],
            [['order_date', 'require_date', 'ship_date', 'products'], 'safe'],
            [['freight', 'total_price', 'status'], 'required'],
            [['freight', 'total_price','total_price'], 'number'],
            [['note', 'fee_info', 'payment_info', 'billing_info','tax','ship', 'billing_address', 'type', 'description'], 'string'],
            [['ship_name', 'ship_phone', 'ship_email', 'ship_address', 'ship_city', 'ship_district', 'ship_ward', 'ship_postalcode', 'ship_country', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Mã đơn hàng',
            'customer_id' => 'Customer ID',
            'employee_id' => 'Employee ID',
            'order_date' => 'Ngày đặt',
            'require_date' => 'Require Date',
            'ship_date' => 'Ngày giao hàng',
            'shiper_id' => 'Shiper ID',
            'freight' => 'Phí vận chuyển',
            'ship_name' => 'Khách hàng',
            'ship_phone' => 'Số điện thoại',
            'ship_email' => 'Email',
            'ship_address' => 'Địa chỉ',
            'ship_city' => 'Tỉnh/Thành phố',
            'ship_district' => 'Quận/Huyện',
            'ship_ward' => 'Phường/Xã',
            'ship_postalcode' => 'Ship Postalcode',
            'ship_country' => 'Quốc gia',
            'total_price' => 'Tổng tiền',
            'status' => 'Trạng thái',
            'note' => 'Ghi chú',
            'payment_type' => 'Payment Type',
            'notification_type' => 'Notification Type',
            'ship_status' => 'Giao hàng',
            'payment_status' => 'Thanh toán',
        ];
    }

    public function getProvince()
    {
        return $this->hasOne(Province::className(),['id'=>'ship_city']);
    }

    public function getDistrict()
    {
        return $this->hasOne(District::className(),['id'=>'ship_district']);
    }

    public function getWard()
    {
        return $this->hasOne(Ward::className(),['id'=>'ship_ward']);
    }
}
