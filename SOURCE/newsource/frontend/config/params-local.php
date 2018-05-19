<?php

return [
    'css_path' => 'http://192.168.146.252:9501/',
    'js_path' => 'http://192.168.146.252:9501/',
    'media_path' => 'http://127.0.0.1:8003/uploads',
    'upload_prefix' => '/media1',
    'album_default_media_path' => 'http://192.168.146.252:9501/images/album_default.png',
    'video_default_media_path' => 'http://192.168.146.252:9501/images/video_default.png',

    'album_default_thumb_path' => '/images/album_default.png',
    'video_default_thumb_path' => '/images/video_default.png',
    'member_default_thumb_path' => '/images/bg_menu.jpg',
    'media_thumb_path' => 'http://192.168.146.252:9501/uploads/thumb',
    'album_default_thumb_full_path' => '/home/khanhnq16/imuzik4g/wap/web/images/album_default.png',
    'video_default_thumb_full_path' => '/home/khanhnq16/imuzik4g/wap/web/images/video_default.png',
    'member_default_thumb_full_path' => '/home/khanhnq16/imuzik4g/wap/web/images/bg_menu.jpg',
    'image_thumb_path' => '/home/khanhnq16/imuzik4g/wap/web/uploads/thumb',

//    'upload_path' => 'E:\\Duan\WEB\\QT01_15002_NEWIMUZIK\\06.SOURCE\\Draft\\imuzik4g\\wap\\web\\uploads',
    'upload_path' => '/home/khanhnq16/imuzik4g/wap/web/uploads',
    'default_bg_blur_song' => 'http://192.168.146.252:9501/images/defaultBgBlurSong.jpg',
    'default_bg_blur_video' => 'http://192.168.146.252:9501/images/defaultBgBlurVideo.jpg',
    'server_name' => '4g.imuzik.com.vn',        
    'captcha' => [
        'class' => 'common\libs\WapCaptcha',
        'transparent' => true,
        'foreColor' => 0xffff00,
        'minLength' => 4,
        'maxLength' => 6,
        'offset' => -2,
        'chars' => 'abcdefhjkmnpqrstuxyz2345678',
        'libfont' => [
            0 => '@wap/web/css/fonts/captcha/vavobi.ttf',
            1 => '@wap/web/css/fonts/captcha/momtype.ttf',
            2 => '@wap/web/css/fonts/captcha/captcha4.ttf'

        ]
    ],
    'upload_dir' =>[
        'register' => '\upload\images\register',
    ],
    'page_movie' => 6,

];
