<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/template/main.css',
//        'css/template/nonscript.css',
//        'css/template/sass/main.css',
//        'css/template/fontawesome-all.min.css',
        'css/site.css',
        'css/main.css',
        'css/fancybox.css',
//        'css/template/sass/nonscript.css',
//        'css/template/sass/_functions.css',
//        'css/template/sass/_html-grid.css',
//        'css/template/sass/_vars.css',
//        'css/template/sass/_vendor.css',
    ];
    public $js = [
        'js/template/jquery.scrollex.min.js',
        'js/template/jquery.scrolly.min.js',
        'js/template/browser.min.js',
        'js/template/breakpoints.min.js',
        'js/scripts.js',
        'js/template/util.js',
        'js/template/main.js',
        'js/fancybox.js',
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
