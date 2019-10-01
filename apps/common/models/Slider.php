<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $base_url
 * @property string $path
 * @property string $url
 * @property int $status
 * @property int $order
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * @var
     */
    public $picture;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::class,
                'attribute' => 'picture',
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
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status', 'order', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['base_url', 'path', 'url'], 'string', 'max' => 1024],
            ['picture', 'safe']
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
            'url' => 'Url',
            'status' => 'Status',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @param null $default
     * @return bool|null|string
     */
    public static function getImage($sliderID)
    {
        $slider = Slider::findOne($sliderID);
        return $slider->path
            ? Yii::getAlias($slider->base_url . '/' . $slider->path)
            : '';
    }
}
