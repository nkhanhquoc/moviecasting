<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/font-opensans/css/font-opensans.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'plugins/simple-line-icons/simple-line-icons.min.css',
        'plugins/bootstrap/css/bootstrap.min.css',
        'css/components-md.min.css',
        'css/plugins-md.min.css',
        'css/layout.min.css',
        'css/themes/darkblue.min.css',
        'css/custom.css?v1.9'
    ];
    public $js = [
        'plugins/bootstrap/js/bootstrap.min.js',
        'plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'js/metronic/app.min.js',
        'js/metronic/layout.min.js',
        'js/metronic/quick-sidebar.min.js',
        'js/admin.js?v1.0',
        'plugins/ckeditor/ckeditor/ckeditor.js',
        'js/styles.js'
       
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
