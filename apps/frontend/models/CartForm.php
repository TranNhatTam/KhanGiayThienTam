<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/22/2018
 * Time: 11:43 AM
 */

namespace frontend\models;


use Yii;
use yii\base\Model;

class CartForm extends Model
{
    public $ship_name;
    public $ship_phone;
    public $ship_email;
    public $ship_address;
    public $ship_district;
    public $ship_ward;
    public $ship_city;
    public $note;
    public $total_price;
    public $type;

    public function rules()
    {
        return [
            [['ship_ward', 'ship_district', 'ship_name', 'ship_phone', 'ship_address', 'total_price', 'ship_city'], 'required', 'message' => '{attribute} không được bỏ trống!'],
            [['ship_name', 'ship_phone', 'ship_email', 'ship_address', 'ship_district', 'ship_ward', 'type', 'ship_city'], 'string', 'max' => 255],
            ['total_price', 'double'],
            ['note', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ship_name' => Yii::t('frontend', 'Tên người nhận'),
            'ship_phone' => Yii::t('frontend', 'Số điện thoại'),
            'ship_email' => Yii::t('frontend', 'Email'),
            'ship_address' => Yii::t('frontend', 'Địa chỉ'),
            'ship_city' => Yii::t('frontend', 'Tỉnh/Thành phố'),
            'ship_district' => Yii::t('frontend', 'Quận/Huyện'),
            'ship_ward' => Yii::t('frontend', 'Phường/Xã'),
            'note' => Yii::t('frontend', 'Ghi chú'),
            'total_price' => Yii::t('frontend', 'Tổng giá'),
        ];
    }

}