<?php

$config = [
    'layout' => 'layout.twig',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'k3smOMhfJ309R6rBGNWdSjKLt5LuuuLf',
            //'csrfParam' => '_backendCSRF',
            'csrfCookie' => [
                'httpOnly' => true,
                //'path' => '/admin',
            ],
            'class' => 'common\libs\WapRequest'
        ],
//        'db' => require(__DIR__ . '/db.php'),
        'view' => [
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    // set cachePath to false in order to disable template caching
//                    'cachePath' => '@runtime/Twig/cache',
                    'cachePath' => false,
                    // Array of twig options:
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'frontend_assets' => 'frontend\assets\AppAsset',
                        'html' => '\yii\helpers\Html'
                    ],
                    'extensions' => [
                        ['yii2-twig', new \frontend\components\TwigExtension()]
                    ],
                ],
            ],
        ]
    ],
];

if (!YII_ENV_PROD) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
