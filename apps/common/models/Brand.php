<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string $name
 * @property string $thumbnail_path
 * @property string $thumbnail_base_url
 * @property string $icon
 * @property string $description
 * @property int $priority
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 * @property int $url_id
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $thumbnail;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::class,
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url_id'], 'required'],
            [['description'], 'string'],
            [['priority', 'is_deleted', 'url_id'], 'integer'],
            [['thumbnail', 'updated_at', 'created_at'], 'safe'],
            [['name', 'thumbnail_path', 'thumbnail_base_url', 'icon'], 'string', 'max' => 255],
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
            'thumbnail_path' => 'Thumbnail Path',
            'thumbnail_base_url' => 'Thumbnail Base Url',
            'thumbnail' => 'Thumbnail',
            'icon' => 'Icon',
            'description' => 'Description',
            'priority' => 'Priority',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'is_deleted' => 'Is Deleted',
            'url_id' => 'Url ID',
        ];
    }
}
