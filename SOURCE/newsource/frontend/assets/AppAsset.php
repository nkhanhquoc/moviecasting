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
        'css/bootstrap.min.css',
        'css/imuzik.css',
        'css/jquery.mmenu.css',
        'css/jquery.jscrollpane.css',
        'css/owl.carousel.min.css',
        'css/font-awesome.css',
        'css/coder-update.css',
    ];
    public $js = [
        'js/jquery.mousewheel.js',
        'js/jquery.mmenu.min.js',
        'js/jQuery.base64.js',
        'js/jquery.rotate.js',
        'js/bootstrap.min.js',
        'js/bootstrap-select.js',
        'js/jscrollpane.min.js',
        'js/owl.carousel.min.js',
        'js/imuzik.js',
        'js/nouislider/nouislider.min.js',
        'js/jquery.jplayer.js',
        'js/jplayer.playlist.js',
        'js/imuzikPlayer.js',
        'js/imuzikVideoPlayer.js',
        // 'js/imuzikCrbtPlayer.js',
        'js/imuzik-custom.js',
        'js/share.js',
        'js/song.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
