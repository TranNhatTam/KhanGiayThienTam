<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $base_url
 * @property string $path
 * @property string $title
 * @property string $content
 * @property int $type
 * @property int $status
 * @property string $username
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 */
class Posts extends \yii\db\ActiveRecord
{
    const TYPE_NEWS = 1;
    const TYPE_PROMOTIONS = 2;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 2;

    /**
     * @var
     */
    public $thumbnail;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::class,
                'attribute' => 'thumbnail',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['type', 'status'], 'required'],
            [['type', 'status', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['base_url', 'path', 'title'], 'string', 'max' => 1024],
            [['username'], 'string', 'max' => 255],
            ['thumbnail', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'base_url' => 'Base Url',
            'path' => 'Path',
            'title' => 'Title',
            'content' => 'Content',
            'type' => 'Type',
            'status' => 'Status',
            'username' => 'Username',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'thumbnail' => 'Thumbnail',
        ];
    }

    /**
     * Returns posts types list
     * @return array|mixed
     */
    public static function types()
    {
        return [
            self::TYPE_NEWS => Yii::t('common', 'Tin Tức'),
            self::TYPE_PROMOTIONS => Yii::t('common', 'Ưu Đãi'),
        ];
    }

    /**
     * Returns posts statues list
     * @return array|mixed
     */
    public static function statues()
    {
        return [
            self::STATUS_ENABLE => Yii::t('common', 'Hiện'),
            self::STATUS_DISABLE => Yii::t('common', 'Ẩn'),
        ];
    }
}
