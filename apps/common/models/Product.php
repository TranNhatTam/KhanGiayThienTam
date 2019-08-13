<?php

namespace common\models;

use backend\models\ProductForm;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $url_id
 * @property string $name
 * @property int $category_id
 * @property int $brand_id
 * @property double $unit_price
 * @property int $discount
 * @property int $star_rating
 * @property int $total_view
 * @property string $status
 * @property string $description
 * @property string $short_detail
 * @property string $warranty
 * @property int $group_id
 * @property string $technical_detail
 * @property string $additional_detail
 * @property int $unit_in_stock
 * @property int $quantity_in_stock
 * @property int $suppiler_id
 * @property string $product_ref
 * @property int $weight
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property string $code
 * @property int $is_deleted
 * @property int $priority
 * @property Urls $urls
 * @property ProductTag $productTag
 * @property OrderDetails[] $orderDetails
 * @property string $fullPathImageThumbnail
 * @property Category $category
 */
class Product extends ActiveRecord
{
    /**
     * @var array
     */
    public $attachments;
    public $thumbnail;
    public $tags;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @return ActiveQuery
     */
    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

//            'softDeleteBehavior' => [
//                'class' => SoftDeleteBehavior::className(),
//                'softDeleteAttributeValues' => [
//                    'is_deleted' => true
//                ],
//                'replaceRegularDelete' => true // mutate native `delete()` method
//            ],
            TimestampBehavior::class,
            BlameableBehavior::class,
//            [
//                'class' => SluggableBehavior::class,
//                'attribute' => 'title',
//                'immutable' => true,
//            ],
//            [
//                'class' => UploadBehavior::class,
//                'attribute' => 'attachments',
//                'multiple' => true,
//                'uploadRelation' => 'productImages',
//                'pathAttribute' => 'path',
//                'baseUrlAttribute' => 'base_url',
////                'orderAttribute' => 'order',
////                'typeAttribute' => 'type',
////                'sizeAttribute' => 'size',
////                'nameAttribute' => 'name',
//            ],
//            [
//                'class' => UploadBehavior::class,
//                'attribute' => 'thumbnail',
//                'pathAttribute' => 'thumbnail_path',
//                'baseUrlAttribute' => 'thumbnail_base_url',
//            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'brand_id', 'unit_price', 'description', 'short_detail', 'weight', 'code', 'url_id'], 'required', 'message' => '{attribute} không được bỏ trống'],
            [['category_id', 'brand_id', 'discount', 'star_rating', 'total_view', 'group_id', 'suppiler_id', 'weight', 'url_id', 'priority'], 'integer'],
            [['unit_price'], 'number'],
            [['description', 'short_detail', 'technical_detail'], 'string'],
            [['name', 'status', 'warranty', 'additional_detail', 'product_ref'], 'string', 'max' => 255],
            [['thumbnail', 'attachments', 'tags'], 'safe'],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 255],
            [['code'], 'unique', 'message' => '{attribute} đã tồn tại'],
            [['quantity_in_stock', 'unit_in_stock'], 'integer', 'min' => 0, 'message' => '{attribute} không được nhỏ hơn 0.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Sản Phẩm',
            'category_id' => 'Loại sản phẩm',
            'brand_id' => 'Nhà sản xuất',
            'unit_price' => 'Giá',
            'discount' => 'Discount',
            'star_rating' => 'Star Rating',
            'total_view' => 'Total View',
            'status' => 'Status',
            'description' => 'Mô tả',
            'short_detail' => 'Trích dẫn',
            'warranty' => 'Warranty',
            'group_id' => 'Group ID',
            'technical_detail' => 'Technical Detail',
            'additional_detail' => 'Additional Detail',
            'unit_in_stock' => 'Đơn vị trong kho',
            'quantity_in_stock' => 'Số lượng còn trong kho',
            'suppiler_id' => 'Suppiler ID',
            'product_ref' => 'Product Ref',
            'category.name' => 'Loại',
            'brand.name' => 'Nhà sản xuất',
            'weight' => 'Khối lượng',
            'thumbnail' => 'Hình Ảnh',
            'code' => 'Mã sản phẩm',
            'tags' => 'Nhãn',
            'priority' => 'Độ ưu tiên',
        ];
    }

    public function getProductImage()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrls()
    {
        return $this->hasOne(Urls::class, ['id' => 'url_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTag()
    {
        return $this->hasMany(ProductTag::class, ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::class, ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetails::class, ['product_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getFullPathImageThumbnail()
    {
        if ($this->thumbnail_base_url) {
            $image = $this->thumbnail_base_url . '/' . $this->thumbnail_path;
        } else
            $image = '/img/image-not-available.png';

        return $image;
    }
}
