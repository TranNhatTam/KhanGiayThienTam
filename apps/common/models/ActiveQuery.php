<?php
/**
 * Nguyen Lieu Pha Che Si Project
 *
 * @copyright 2018 Nguyen An All Right Reserved
 * @link http://nguyenlieuphachesi.com
 */

namespace common\models;

use yii\db\ActiveQuery as BaseActiveQuery;

/**
 * ActiveQuery
 *
 * @package Nguyen Lieu Pha Che Si
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class ActiveQuery extends BaseActiveQuery
{

    public function visible()
    {
        return $this->andWhere(['is_deleted' => ActiveRecord::VISIBLE]);
    }

}