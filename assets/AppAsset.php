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
        'css/dataTables.bootstrap4.min.css', // Contiene estilos css de bootstrap
        'css/styles.css', // Contiene los estilos principales del sistema
        'css/sweetalert2.min.css', // Contiene los estilos css de la librería SweetAlert2
        'css/animate.min.css', // Contiene los estilos de la librería animate
        //'Bootstrap_material/css/mdb.min.css',
    ];
    public $js = [
        'js/all.min.js', //Contiene los iconos de la librería Fontawesome
        //'https://code.jquery.com/jquery-3.5.1.slim.min.js',
        'js/bootstrap.bundle.min.js',
        'js/scripts.js', //Contiene el script del menu del sistema
        'js/Chart.min.js', //Contiene la libreria de graficas Chart.js
        'js/chartprincipal.js',
        'js/jquery.dataTables.min.js',  // Contiene script de la libreria DataTable
        'js/dataTables.bootstrap4.min.js', // Contiene script de bootstrap js
        'assets/demo/datatables-demo.js', // Contiene ejemplos de DataTable
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
