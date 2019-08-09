<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $location
 * @property string $province_id
 * @property int $is_deleted
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'type', 'location', 'province_id'], 'required'],
            [['is_deleted'], 'integer'],
            [['id', 'name', 'type', 'location', 'province_id'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'location' => 'Location',
            'province_id' => 'Province ID',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
