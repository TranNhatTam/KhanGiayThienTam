<?php

namespace common\models;

use common\models\query\ActiveQuery;
use common\models\record\ActiveRecord;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $thumbnail_path
 * @property string $thumbnail_base_url
 * @property double $unit_price
 * @property int $unit_in_stock
 * @property int $quantity_in_stock
 * @property double $discount
 * @property int $star_rating
 * @property int $total_view
 * @property string $warranty
 * @property string $short_detail
 * @property string $description
 * @property string $technical_detail
 * @property string $additional_detail
 * @property int $status
 * @property int $priority
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 * @property int $brand_id
 * @property int $category_id
 * @property int $url_id
 * @property string $images
 * @property Url $url
 */
class Product extends ActiveRecord
{

    const UNIT_IN_STOCK_TYPE_1 = 1;

    const STATUS_IN_STOCK = 1;
    const STATUS_OUT_OF_STOCK = 2;
    const STATUS_STOP_PRODUCTION = 3;
    const STATUS_DELETED = 4;

    /**
     * @var array
     */
    public $thumbnail;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
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
            [['name', 'code', 'category_id', 'url_id'], 'required'],
            [['unit_price', 'discount'], 'number'],
            [['unit_in_stock', 'quantity_in_stock', 'star_rating', 'total_view', 'status', 'priority', 'is_deleted', 'brand_id', 'category_id', 'url_id'], 'integer'],
            [['short_detail', 'description', 'technical_detail', 'additional_detail', 'images'], 'string'],
            [['thumbnail', 'created_at', 'updated_at'], 'safe'],
            [['name', 'code', 'thumbnail_path', 'thumbnail_base_url', 'warranty'], 'string', 'max' => 255],
            [['code'], 'unique'],
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
            'code' => 'Code',
            'thumbnail_path' => 'Thumbnail Path',
            'thumbnail_base_url' => 'Thumbnail Base Url',
            'unit_price' => 'Unit Price',
            'unit_in_stock' => 'Unit In Stock',
            'quantity_in_stock' => 'Quantity In Stock',
            'discount' => 'Discount',
            'star_rating' => 'Star Rating',
            'total_view' => 'Total View',
            'warranty' => 'Warranty',
            'short_detail' => 'Short Detail',
            'description' => 'Description',
            'technical_detail' => 'Technical Detail',
            'additional_detail' => 'Additional Detail',
            'status' => 'Status',
            'priority' => 'Priority',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'brand_id' => 'Brand ID',
            'category_id' => 'Category ID',
            'url_id' => 'Url ID',
            'images' => 'Images',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }

    public static function getArrayProduct()
    {
        return ArrayHelper::map(Product::find()->all(), 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrl()
    {
        return $this->hasOne(Url::class, ['id' => 'url_id']);
    }

    /**
     * Returns product unitInStocks list
     * @return array|mixed
     */
    public static function unitInStocks()
    {
        return [
            self::UNIT_IN_STOCK_TYPE_1 => Yii::t('common', 'Cái'),
        ];
    }

    /**
     * Returns product statuses list
     * @return array|mixed
     */
    public static function statuses()
    {
        return [
            self::STATUS_IN_STOCK => Yii::t('common', 'In Stock'),
            self::STATUS_OUT_OF_STOCK => Yii::t('common', 'Out Of Stock'),
            self::STATUS_STOP_PRODUCTION => Yii::t('common', 'Stop Production'),
            self::STATUS_DELETED => Yii::t('common', 'Deleted')
        ];
    }

    public function getThumbnail($default = null)
    {
        return $this->thumbnail_path
            ? Yii::getAlias($this->thumbnail_base_url . '/' . $this->thumbnail_path)
            : $default;
    }
}
