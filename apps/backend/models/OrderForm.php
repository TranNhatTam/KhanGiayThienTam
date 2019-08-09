<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/9/2018
 * Time: 4:52 PM
 */

namespace backend\models;



use yii\base\Model;
use yii2mod\cart\models\CartItemInterface;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $customer_id
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
 * @property string $status
 * @property string $note
 * @property int $payment_type
 * @property int $notification_type
 * @property int $ship_status
 * @property int $payment_status
 */
class OrderForm extends Model
{
    public $customer_id;
    public $order_date;
    public $ship_name;
    public $ship_phone;
    public $ship_email;
    public $ship_address;
    public $ship_city;
    public $ship_district;
    public $ship_ward;
    public $ship_postalcode;
    public $ship_country;
    public $total_price;
    public $status;
    public $note;
    public $payment_type;
    public $notification_type;
    public $ship_status;
    public $payment_status;

}