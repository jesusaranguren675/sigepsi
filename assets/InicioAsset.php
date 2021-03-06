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
class InicioAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/inicio.css',
    ];
    public $js = [
        'js/all.min.js',
        'https://code.jquery.com/jquery-3.5.1.slim.min.js',
        'js/bootstrap.bundle.min.js',
        'js/Chart.min.js',
        'assets/demo/chart-area-demo.js',
        'assets/demo/chart-bar-demo.js',
        'js/jquery.dataTables.min.js',
        'js/dataTables.bootstrap4.min.js',
        'assets/demo/datatables-demo.js',
        'js/scripts.js',
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
