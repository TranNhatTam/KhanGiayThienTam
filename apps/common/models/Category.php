<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
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
class Category extends \yii\db\ActiveRecord
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
        return 'category';
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
            'create_at' => 'Created At',
            'is_deleted' => 'Is Deleted',
            'url_id' => 'Url ID',
        ];
    }

    public static function getArrayCategory()
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'name');
    }
}
