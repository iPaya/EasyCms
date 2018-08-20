<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Components\Formatter;

$params = require __DIR__ . '/params.php';

return [
    'language' => 'zh-CN',
    'timezone' => 'Asia/Shanghai',
    'basePath' => EASYCMS_ROOT . '/src',
    'vendorPath' => VENDOR_PATH,
    'runtimePath' => DASHBOARD_RUNTIME_PATH,
    'bootstrap' => [
        'log',
        'App\Bootstrap\UrlManagerBootstrap',
    ],
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
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'fileSystem' => [
            'class' => 'App\FileSystem\Component',
            'adapter' => new League\Flysystem\Adapter\Local(EASYCMS_ROOT . '/files'),

        ],
        'formatter' => function () {
            return new Formatter([
                'sizeFormatBase' => 1000,
                'datetimeFormat' => 'php: Y-m-d H:i:s'
            ]);
        },
        'settings' => [
            'class' => 'pheme\settings\components\Settings'
        ],
        'mailer' => function () {
            $settings = App\Settings\MailSettings::getInstance();
            return $settings->createMailer();
        },
        'alertManager' => [
            'class' => 'App\Components\AlertManager'
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'App\Models\User'
        ],
        'queue' => [
            'class' => 'App\Queue\RedisQueue',
            'redis' => [
                'class' => 'yii\redis\Connection',
                'hostname' => getenv('REDIS_HOST'),
                'port' => getenv('REDIS_PORT'),
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
            ]
        ]
    ],
    'params' => $params,
];

