<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $url_id
 * @property string $category_code
 * @property string $name
 * @property int $priority
 * @property string $category_icon
 * @property string $description
 * @property double $extra_number
 * @property string $extra_text
 * @property double $extra_lbs
 * @property int $is_parent
 * @property int $parent_id
 * @property int $is_show
 * @property int $number
 * @property int $group_id
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property Product[] $products
 * @property Urls $urls
 */
class Category extends ActiveRecord
{
    const GROUP_BESTSELLER = 1;
    const GROUP_PROMOTION = 2;
    const GROUP_NORMAL = 3;

    /**
     * @var array
     */
    public $thumbnail;
    public $brands;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
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
            [['name', 'priority'], 'required'],
            [['priority', 'is_parent', 'parent_id', 'group_id', 'url_id', 'number', 'is_show'], 'integer'],
            [['description', 'extra_text'], 'string'],
            [['extra_number', 'extra_lbs'], 'number'],
            [['category_code', 'name', 'category_icon'], 'string', 'max' => 255],
            [['thumbnail', 'brands'], 'safe'],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            ['url_id', 'default', 'value' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_code' => 'Mã Thể Loại',
            'name' => 'Tên',
            'priority' => 'Độ Ưu Tiên',
            'category_icon' => 'Icon Thể Loại',
            'description' => 'Mô Tả',
            'extra_number' => 'Extra Number',
            'extra_text' => 'Extra Text',
            'extra_lbs' => 'Extra Lbs',
            'is_parent' => 'Is Parent',
            'parent_id' => 'Parent ID',
            'group_id' => 'Group ID',
            'thumbnail' => 'Hình Ảnh',
            'brands' => 'Nhà sản xuất',
            'is_show'=>'Chế độ xem',
            'number'=> 'Số sản phẩm hiển trang chủ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategory()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id'])->limit(8);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrls()
    {
        return $this->hasOne(Urls::class, ['id' => 'url_id']);

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
