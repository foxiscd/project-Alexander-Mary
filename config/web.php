<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ruRu',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'layout' => 'default',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'KnPtLXC05z2o6LrbRtZ2xsToVcFy_Yj0',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'messageConfig' => [
                'charset' => 'UTF-8',
            ],
            // Mail account settings
            'transport' => include_once __DIR__ . '/../settings.php',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'main/index',
                'portfolio' => 'main/portfolio',
                'contacts' => 'main/contacts',
                'price' => 'main/price',
                'user/<id:\d+>/activate/<code:.*>/' => 'user/activation',
                'photo/<id:\d+>/edit/' => 'photo/edit',
                'photo/<id:\d+>/delete/' => 'photo/delete',
                'post/<id:\d+>/detail/' => 'post/detail',
                'post/<id:\d+>/edit/' => 'post/edit',
                'admin/panel/' => 'admin/panel/index',
                'admin/posts' => 'admin/panel/posts',
                'admin/photo' => 'admin/panel/photo',
                'admin/help' => 'admin/panel/help',
                'admin/accounts' => 'admin/panel/account-list',
                'training-status/change/<id:\d+>' => 'account/training/change',
                'account-setting/<user_id:\d+>/edit/' => 'account/setting/edit',
                'account/<id:\d+>/settings' => 'account/account-card/settings-index',
                'account/<id:\d+>' => 'account/account-card/view',
                'album-photo-portfolio/<id:\d+>/view' => 'album-photo-portfolio/view',
                'album-photo-portfolio/<id:\d+>/edit' => 'album-photo-portfolio/edit',
            ],
        ],
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
