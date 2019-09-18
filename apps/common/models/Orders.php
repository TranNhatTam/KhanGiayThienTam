<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $employee_id
 * @property string $order_date
 * @property string $ship_date
 * @property string $fee_info
 * @property string $billing_info
 * @property string $payment_info
 * @property int $shipper_id
 * @property double $freight
 * @property string $ship_name
 * @property string $ship_phone
 * @property string $ship_email
 * @property string $ship_address
 * @property string $ship_city
 * @property string $ship_district
 * @property string $ship_ward
 * @property string $ship_postcode
 * @property string $ship_country
 * @property double $total_price
 * @property double $total_tax
 * @property int $status
 * @property int $ship_status
 * @property int $payment_status
 * @property string $note
 * @property int $payment_type
 * @property int $notification_type
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 */
class Orders extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_PROCESSED = 1;
    const STATUS_FINISHED = 2;
    const STATUS_CANCELLED = 3;

    const SHIP_STATUS_NOT_DELIVERY = 0;
    const SHIP_STATUS_DELIVERED = 1;

    const PAYMENT_STATUS_NOT_PAYING = 0;
    const PAYMENT_STATUS_PAID = 1;

    const PAYMENT_TYPE_CASH = 0;
    const PAYMENT_TYPE_BANK_TRANSFER = 1;
    const PAYMENT_TYPE_COD = 2;

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
            [['customer_id', 'employee_id', 'shipper_id', 'status', 'ship_status', 'payment_status', 'payment_type', 'notification_type', 'is_deleted'], 'integer'],
            [['order_date', 'ship_date', 'created_at', 'updated_at'], 'safe'],
            [['fee_info', 'billing_info', 'payment_info', 'note'], 'string'],
            [['freight', 'total_price', 'status'], 'required'],
            [['freight', 'total_price', 'total_tax'], 'number'],
            [['ship_name', 'ship_phone', 'ship_email', 'ship_address', 'ship_city', 'ship_district', 'ship_ward', 'ship_postcode', 'ship_country'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'employee_id' => 'Employee ID',
            'order_date' => 'Order Date',
            'ship_date' => 'Ship Date',
            'fee_info' => 'Fee Info',
            'billing_info' => 'Billing Info',
            'payment_info' => 'Payment Info',
            'shipper_id' => 'Shipper ID',
            'freight' => 'Freight',
            'ship_name' => 'Ship Name',
            'ship_phone' => 'Ship Phone',
            'ship_email' => 'Ship Email',
            'ship_address' => 'Ship Address',
            'ship_city' => 'Ship City',
            'ship_district' => 'Ship District',
            'ship_ward' => 'Ship Ward',
            'ship_postcode' => 'Ship Postcode',
            'ship_country' => 'Ship Country',
            'total_price' => 'Total Price',
            'total_tax' => 'Total Tax',
            'status' => 'Status',
            'ship_status' => 'Ship Status',
            'payment_status' => 'Payment Status',
            'note' => 'Note',
            'payment_type' => 'Payment Type',
            'notification_type' => 'Notification Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * Returns order statuses list
     * @return array|mixed
     */
    public static function statuses()
    {
        return [
            self::STATUS_PENDING => Yii::t('common', 'Pending'),
            self::STATUS_PROCESSED => Yii::t('common', 'Processed'),
            self::STATUS_FINISHED => Yii::t('common', 'Finished'),
            self::STATUS_CANCELLED => Yii::t('common', 'Cancelled')
        ];
    }

    /**
     * Returns order shipStatuses list
     * @return array|mixed
     */
    public static function shipStatuses()
    {
        return [
            self::SHIP_STATUS_NOT_DELIVERY => Yii::t('common', 'Not Delivery'),
            self::SHIP_STATUS_DELIVERED => Yii::t('common', 'Delivered')
        ];
    }

    /**
     * Returns order paymentStatues list
     * @return array|mixed
     */
    public static function paymentStatues()
    {
        return [
            self::PAYMENT_STATUS_NOT_PAYING => Yii::t('common', 'Not Paying'),
            self::PAYMENT_STATUS_PAID => Yii::t('common', 'Paid')
        ];
    }

    /**
     * Returns order paymentTypes list
     * @return array|mixed
     */
    public static function paymentTypes()
    {
        return [
            self::PAYMENT_TYPE_CASH => Yii::t('common', 'Cash'),
            self::PAYMENT_TYPE_BANK_TRANSFER => Yii::t('common', 'Bank Transfer'),
            self::PAYMENT_TYPE_COD => Yii::t('common', 'COD')
        ];
    }
}
