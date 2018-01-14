<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/meta_country.php'),
    require(__DIR__ . '/meta_language.php'),
    require(__DIR__ . '/meta_year.php'),
    require(__DIR__ . '/meta_content_filter.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'vi',
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'mainLayout' => '@backend/views/layouts/main.php',
        ],
        'roxymce' => [
            'class' => 'navatech\roxymce\Module',
            'uploadFolder' => '@backend/web/upload/images',
            'uploadUrl' => 'http://mediamc.nkhanhquoc.com/upload/images',
        ],
        'gridview' => 'kartik\grid\Module',
    ],
    'components' => [
        'user' => [
            'identityClass' => 'backend\models\User',
//            'enableAutoLogin' => true,
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_cmsIdentity',
                'httpOnly' => true,
                'expire' => 7200,
            ],
            'authTimeout'=> 7200, //ONE MINUTE.
        ],

        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '192.168.146.252',
            'port' => 9600,
            'database' => 2,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => '/site/index',
                'login' => '/site/login',
                'logout' => '/site/logout',
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@logs/cms/error.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logFile' => '@logs/cms/warning.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logFile' => '@logs/cms/info.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['yii\db\Command*'],
                    'logVars' => [],
                    'logFile' => '@logs/cms/queries.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['s3'],
                    'logFile' => '@logs/cms/s3.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
		'gridview' => 'kartik\grid\Module',
        'i18n' => [
            'translations' => [
                'kvdrp*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                ],

            ],
        ],
    ],

    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
//            '*',
            'site/*',
        ]
    ],
    'params' => $params,
];
