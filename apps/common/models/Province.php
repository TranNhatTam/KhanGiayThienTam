<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property int $is_deleted
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'type'], 'required'],
            [['is_deleted'], 'integer'],
            [['id', 'name', 'type'], 'string', 'max' => 255],
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
            'is_deleted' => 'Is Deleted',
        ];
    }
}
