<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

$config = [
    'id' => 'dashboard',
    'controllerNamespace' => 'App\Controllers',
    'bootstrap' => ['log'],
    'modules' => [
        getenv('ADMIN_MODULE') => [
            'class' => 'App\Modules\Admin\Module'
        ]
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'asdf',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ]
];

if (YII_ENV == 'dev') {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
}

return $config;