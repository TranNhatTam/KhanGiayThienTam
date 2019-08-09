<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_brand".
 *
 * @property int $category_id
 * @property int $brand_id
 */
class CategoryBrand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_brand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'brand_id'], 'required'],
            [['category_id', 'brand_id'], 'integer'],
            [['category_id', 'brand_id'], 'unique', 'targetAttribute' => ['category_id', 'brand_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category',
            'brand_id' => 'Brand',
        ];
    }
}
