<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ward".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $location
 * @property string $district_id
 * @property int $is_deleted
 */
class Ward extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ward';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'type', 'location', 'district_id'], 'required'],
            [['is_deleted'], 'integer'],
            [['id', 'name', 'type', 'location', 'district_id'], 'string', 'max' => 255],
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
            'district_id' => 'District ID',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
