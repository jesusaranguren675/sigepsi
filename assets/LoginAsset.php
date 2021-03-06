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
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/dataTables.bootstrap4.min.css',
        'css/login.css',
    ];
    public $js = [
        'js/all.min.js',
        'https://code.jquery.com/jquery-3.5.1.slim.min.js',
        'js/bootstrap.bundle.min.js',
        'js/scripts.js',
        'js/Chart.min.js',
        'assets/demo/chart-area-demo.js',
        'assets/demo/chart-bar-demo.js',
        'js/jquery.dataTables.min.js',
        'js/dataTables.bootstrap4.min.js',
        'assets/demo/datatables-demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
