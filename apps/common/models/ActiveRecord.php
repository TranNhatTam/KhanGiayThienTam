<?php
/**
 * Nguyen Lieu Pha Che Si Project
 *
 * @copyright 2018 Nguyen An All Right Reserved
 * @link http://nguyenlieuphachesi.com
 */

namespace common\models;

use trntv\bus\tests\TestCase;
use trntv\filekit\events\UploadEvent;
use yii\db\ActiveRecord as BaseActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * ActiveRecord
 *
 * @package Nguyen Lieu Pha Che Si
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class ActiveRecord extends BaseActiveRecord
{

    const DELETED = 1;

    const VISIBLE = 0;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->attachBehavior('softDelete', [
            'class' => SoftDeleteBehavior::class,
            'replaceRegularDelete' => true,
            'softDeleteAttributeValues' => [
                'is_deleted' => true,
            ]
        ]);
    }

}