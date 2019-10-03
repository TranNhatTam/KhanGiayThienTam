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
//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    /**
     * @var array
     */
    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto&display=swap',
        'css/bootstrap.css',
        'style.css',
        'css/dark.css',
        'css/font-icons.css',
        'css/animate.css',
        'css/magnific-popup.css',
        'css/responsive.css',

        'include/rs-plugin/css/settings.css',
        'include/rs-plugin/css/layers.css',
        'include/rs-plugin/css/navigation.css',

        'css/custom.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'js/jquery.js',
        'js/plugins.js',
        'js/functions.js',

        'include/rs-plugin/js/jquery.themepunch.tools.min.js',
        'include/rs-plugin/js/jquery.themepunch.revolution.min.js',

        'include/rs-plugin/js/extensions/revolution.extension.video.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.slideanims.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.actions.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.kenburn.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.navigation.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.migration.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.parallax.min.js',

        'js/yii.js',
        'js/jquery.pjax.js',
    ];

    /**
     * @var array
     */
    public $depends = [
//        YiiAsset::class,
//        BootstrapAsset::class,
//        Html5shiv::class,
    ];
}
