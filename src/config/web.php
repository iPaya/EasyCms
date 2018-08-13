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
        ],
        'file' => [
            'class' => 'App\Modules\File\Module'
        ],
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
    ],
    'container' => [
        'definitions' => [
            'yii\widgets\ActiveField' => [
                'hintOptions' => [
                    'class' => 'form-text text-muted'
                ]
            ],
            'yii\widgets\LinkPager' => [
                'linkContainerOptions' => [
                    'class' => 'page-item'
                ],
                'linkOptions' => [
                    'class' => 'page-link'
                ],
                'disabledListItemSubTagOptions' => [
                    'class' => 'page-link'
                ],
            ]
        ]
    ]
];

if (YII_ENV == 'dev') {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
}

return $config;
