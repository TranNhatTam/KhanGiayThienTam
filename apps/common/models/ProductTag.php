<?php

namespace common\models;

use http\Url;
use phpDocumentor\Reflection\Types\String_;
use Yii;

/**
 * This is the model class for table "product_tag".
 *
 * @property int $id
 * @property int $product_id
 * @property int $tag_name
 * @property int $is_deleted
 */
class ProductTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'is_deleted'], 'integer'],
            [['tag_name'], 'string', 'max' => 255],
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
            'tag_name' => 'Tag Name',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class,['id'=>'product_id' ]);
    }

    public function getTag()
    {
        return $this->hasOne(Tag::class,['name'=>'tag_name' ]);
    }

}
