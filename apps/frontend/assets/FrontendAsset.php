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
        'https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700,700i,900,900i&amp;amp;subset=vietnamese',
        'css/style.css',
        'css/animate.css',
        'css/bootstrap.css',
        'css/dark.css',
        'css/font-icons.css',
        'css/magnific-popup.css',
        'css/responsive.css',
        'css/swiper.css',
        'include/rs-plugin/css/settings.css',
        'include/rs-plugin/css/layers.css',
        'include/rs-plugin/css/navigation.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'js/plugins.js',
        'js/functions.js',
        'js/jquery.js',
        'include/rs-plugin/js/jquery.themepunch.tools.min.js',
        'include/rs-plugin/js/jquery.themepunch.revolution.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.video.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.actions.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.slideanims.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.kenburn.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.navigation.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.migration.min.js',
        'include/rs-plugin/js/extensions/revolution.extension.parallax.min.js',
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
