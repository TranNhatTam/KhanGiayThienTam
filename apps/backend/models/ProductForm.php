<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 17/10/2018
 * Time: 5:44 PM
 */

namespace backend\models;


use common\models\Product;
use trntv\filekit\behaviors\UploadBehavior;

class ProductForm extends Product
{

    public function behaviors()
    {
        $new_behaviors = array_merge(parent::behaviors(), [[
            'class' => UploadBehavior::class,
            'attribute' => 'attachments',
            'multiple' => true,
            'uploadRelation' => 'productImages',
            'pathAttribute' => 'path',
            'baseUrlAttribute' => 'base_url',
//                'orderAttribute' => 'order',
//                'typeAttribute' => 'type',
//                'sizeAttribute' => 'size',
//                'nameAttribute' => 'name',
        ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url',
            ]]);
        return $new_behaviors; // TODO: Change the autogenerated stub
    }
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }
}