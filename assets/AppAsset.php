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
//       'css/bootstrap_united.css', //Bootstrap v3.4.1
        'css/bootstrap_united.min.css',   //Bootstrap v4.6.0
        'css/site.css',
    ];
    public $js = [
        //'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset', //Bootstrap v3.4.1
        'yii\bootstrap4\BootstrapAsset', //Bootstrap v4.6.0
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
