<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use common\assets\Html5shiv;
use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Frontend application asset
 */
class FrontendAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    /**
     * @var array
     */
    public $css = [
//        'style.css',
        'http://html5shim.googlecode.com/svn/trunk/html5.js',
        'https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700,700i,900,900i&amp;amp;subset=vietnamese',
        'css/style.css',
        'css/xzoom.css'
//        'css/template/style.css'
    ];

    /**
     * @var array
     */
    public $js = [
//        'js/app.js',
//        'js/libs.js',
        'js/plugins.js',
        'js/start.js',
        'js/xzoom.js'
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        Html5shiv::class,
    ];
}
