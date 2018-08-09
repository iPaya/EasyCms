<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

$params = require __DIR__ . '/params.php';

return [
    'language' => 'zh-CN',
    'timezone' => 'Asia/Shanghai',
    'basePath' => EASYCMS_ROOT . '/src',
    'vendorPath' => VENDOR_PATH,
    'runtimePath' => DASHBOARD_RUNTIME_PATH,
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
        'db' => require __DIR__ . '/db.php',
        'dictManager' => [
            'class' => 'App\Components\DictManager',
        ]
    ],
    'params' => $params,
];

