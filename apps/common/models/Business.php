<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;

/**
 * This is the model class for table "business".
 *
 * @property int $id
 * @property string $hot_line
 * @property string $phone
 * @property string $name
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property string $fullPathImageThumbnail
 * @property string $link_facebook
 * @property string $link_skype
 * @property string $link_google_plus
 */
class Business extends \yii\db\ActiveRecord
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
        return 'business';
    }

    /**
     * @return array
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
            [['thumbnail', 'hot_line', 'name', 'phone'], 'required'],
            [['phone', 'name', 'phone'], 'string', 'max' => 255],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['link_facebook', 'link_google_plus', 'link_skype'], 'string', 'max' => 512],
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
            'hot_line' => 'Hot Line',
            'phone' => 'Phone',
            'thumbnail_base_url' => 'Thumbnail Base Url',
            'thumbnail_path' => 'Thumbnail Path',
            'thumbnail' => 'Logo',
            'link_facebook' => 'Link Facebook',
            'link_skype' => 'Link Skype',
            'link_google_plus' => 'Link Google Plus',
        ];
    }

    /**
     * @return string
     */
    public function getFullPathImageThumbnail()
    {
        if ($this->thumbnail_base_url != null) {
            $image = $this->thumbnail_base_url . '/' . $this->thumbnail_path;
        } else {
            $image = '/img/image-not-available.png';
        }
        return $image;
    }
}
