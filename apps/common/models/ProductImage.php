<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product_image".
 *
 * @property int $id
 * @property int $product_id
 * @property int $color_id
 * @property int $image_id
 * @property int $priority
 * @property string $image_url
 * @property string $image_description
 * @property string $base_url
 * @property string $path
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_image';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'color_id', 'image_id', 'priority'], 'required'],
            [['product_id', 'color_id', 'image_id', 'priority'], 'integer'],
            [['image_description'], 'string'],
            [['image_url', 'path', 'base_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'color_id' => 'Color ID',
            'image_id' => 'Image ID',
            'priority' => 'Priority',
            'image_url' => 'Image Url',
            'image_description' => 'Image Description',
            'base_url' => 'Base Url',
            'path' => 'Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getUrl()
    {
        return $this->base_url . '/' . $this->path;
    }

}
