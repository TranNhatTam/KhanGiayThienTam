<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string $name
 * @property string $brand_icon
 * @property string $brand_image
 * @property string $description
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 */
class Brand extends ActiveRecord
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
     * @return ActiveQuery
     */
    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }

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
            [['name', 'brand_image'], 'required'],
            [['description'], 'string'],
            [['name', 'brand_icon', 'brand_image'], 'string', 'max' => 255],
            [['thumbnail'], 'safe'],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'brand_icon' => 'Icon',
            'brand_image' => 'Image',
            'description' => 'Mô Tả',
            'thumbnail' => 'Hình Ảnh',
        ];
    }
}
