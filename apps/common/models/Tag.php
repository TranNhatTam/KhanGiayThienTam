<?php

namespace common\models;

use http\Url;
use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property int $url_id
 * @property string $name
 * @property string $url
 * @property int $group_id
 * @property int $priority
 * @property int $is_deleted
 * @property Urls $urls
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url_id', 'name'], 'required'],
            [['url_id', 'group_id', 'priority', 'is_deleted'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url_id' => 'Url ID',
            'name' => 'Tên Nhãn',
            'url' => 'Url',
            'group_id' => 'Group ID',
            'priority' => 'Độ ưu tiên',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrl()
    {
        return $this->hasOne(Urls::class, ['id' => 'url_id']);
    }
}
