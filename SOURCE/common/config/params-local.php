<?php

return [
    'media' => [
        'base_url' => 'http://cms.ibox360.vn/upload/media1',
        'root' => 'media1',
        'root_filepath' => '/media/media1',
    ],
    'media_host_replace' => '{media_host}',
    'path_article_replace' => '/uploads/ckfinder/',
    'regex_validation' => [
        'mem_phone' => "/^(\\+\\d{2,4})?((\\d?\\.?\\s?){4,15})$/",
        'mem_email' => "/^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@[a-z0-9-]+(\\.[a-z0-9-]+)*(\\.[a-z]{2,3})$/",
        'price' => "/^(\\+\\d{1,3})?((\\d?\\.?\\s?){0,15})$/"
    ],
    'article_page' => [
        'num_of_news' => 5,
        'num_of_news_per_page' => 20,
        'num_of_related_article' => 4,
        'num_of_related_article_more' => 4,
    ],
    'video_page' => [
        'num_of_video' => 5,
        'num_of_video_per_page' => 8,
        'num_of_related_video' => 4,
        'num_of_related_video_more' => 2,
    ],
    'attribute_article' => [
        1 => 'Tin hot',
        2 => 'Hiển thị trang chủ'
    ],
    'attribute_video' => [
        1 => 'Tin hot',
        2 => 'Hiển thị trang chủ'
    ],
    'viettel_phone_expression' => '/^8496\d{7}$|^8497\d{7}$|^8498\d{7}$|^8416\d{8}$|^0?96\d{7}$|^0?97\d{7}$|^0?98\d{7}$|^0?16\d{8}$/',
    'vnm_phone_expression' => '/^8492\d{7}$|^84188\d{7}$|^84186\d{7}$|^0?92\d{7}$|^0?188\d{7}$|^0?186\d{7}$/',
];
