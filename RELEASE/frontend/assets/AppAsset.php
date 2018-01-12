<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/styles.css',
        'css/validationEngine.jquery.css'
    ];
    public $js = [
        'libs/js/jquery.min.js',
        'libs/bootstrap-3.3.5/js/bootstrap.min.js',
        'libs/js/jquery.cycle2.min.js',
        'libs/js/moment-with-locales.js',
        'libs/js/bootstrap-datetimepicker.min.js',
        'libs/js/selectize.min.js',        
        'js/owl.carousel.js',
        'js/jquery.validationEngine-vi.js',
        'js/jquery.validationEngine.js',
        'js/main.js?v=1.3'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
