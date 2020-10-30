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
    public $scss= [
        'assets/main.scss',
        'assets/nonscript.scss',
        'assets/libs/_functions.scss',
        'assets/libs/_html-grid.scss',
        'assets/libs/_vars.scss',
        'assets/libs/_vendor.scss',
    ];
    public $css = [
        'css/site.css',
        'css/template/fontawesome-all.min.css',
        'css/template/main.css',
        'css/template/nonscript.css',
    ];
    public $js = [
        'js/template/jquery.min.js',
        'js/template/jquery.scrollex.min.js',
        'js/template/jquery.scrolly.min.js',
        'js/template/browser.min.js',
        'js/template/breakpoints.min.js',
        'js/template/util.js',
        'js/template/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
