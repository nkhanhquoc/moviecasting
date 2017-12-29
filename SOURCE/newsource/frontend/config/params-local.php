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
    'common_list_number' => 20,
    'number_rank_song' => 10,
    'number_rank_video' => 10,
    'number_rank_album' => 10,

    'home_song_rank_id' => 2,
    'home_video_rank_id' => 19,
    'home_album_rank_id' => 38,

    'rank_song_vn' => 1,
    'rank_song_eu' => 2,

    'rank_video_vn' => 19,
    'rank_video_eu' => 22,

    'rank_album_vn' => 38,
    'rank_album_eu' => 37,

    'number_hot_singer' => 30,
    # genre_id playlist hot
    'genre_id_playlist_hot' => 5,
    # genre_id video hot
    'genre_id_video_hot' => 5,
    # genre_id chu de hot
    'genre_id_subject_hot' => 5,
    # genre_id ca sy hot
    'genre_id_singer_hot' => 5,
    # genre_id bai hat hot
    'genre_id_song_hot' => 5,
    #genre radio
    'genre_id_radio' => 317,
    # limit auto load singer
    'load_limit_singer' => 20,
    # limit list song,video singer detail
    'load_limit_singer_song' => 20,
    'load_limit_singer_video' => 20,
    # limit video list
    'limit_video_list' => 20,
    'load_limit_video_list' => 10,
    # limit danh sach chi de
    'limit_list_topic' => 20,
    'limit_list_topic_load' => 20,
    'limit_list_topic_load_max' => 100,
    # limit danh sach chi de
    'limit_list_song' => 40,
    'limit_list_song_load' => 20,
    'limit_list_song_load_max' => 100,
    #limit danh sach tim kiem
    'limit_list_search' => 20,
    'limit_search_suggest' => 2,
    # limit list hot home singer
    'limit_list_hot_home_singer' => 6,
    # limit list topic detail
    'limit_list_topic_detail' => 20,
    'limit_list_topic_detail_max' => 100,
    'home_banner_item_id' => 60,
    'home_banner_item_number' => 5,
    # limit singer detail
    'limit_list_singer_video' => 20,
    'limit_list_singer_video_load' => 10,
    'limit_list_singer_video_load_max' => 100,
    'limit_list_singer_song' => 40,
    'limit_list_singer_song_load' => 20,
    'limit_list_singer_song_load_max' => 100,
    'limit_list_singer' => 24,
    'limit_list_rbt_detail' => 24,
    'load_limit_video_list_max' => 100,
    'load_limit_song_list_max' => 100,
    // rbt
    'genre_cbt_hot' => 5,
    'genre_cbt_new' => 6,
    'limit_genre_cbt_hot' => 40,
    'limit_genre_cbt_hot_load' => 20,
    'limit_genre_cbt_hot_load_limit' => 100,
    'limit_cbt_home_hot' => 15,
    'limit_genre_playlist' => 20,
    'limit_genre_playlist_load' => 20,
    'limit_genre_playlist_load_limit' => 100,
    'singer_detail_playlist' => 20,
    'singer_detail_playlist_load' => 20,
    'singer_detail_playlist_load_limit' => 100,
    'max_image_size' => 3*1024*1024,
    # limit playlist detail
    'limit_list_playlist' => 40,
    'limit_list_playlist_detail' => 20,
    'limit_list_playlist_detail_max' => 100,
    'limit_genre_rbt' => 100,
    'genre_id_playlist_new' => 6,
    'list_song_rbt' => 5,
    'limit_topic_detail_song' => 40,
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

];
