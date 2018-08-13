<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


return [
    'id' => 'console',
    'controllerNamespace' => 'App\Commands',
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@Root/src/migrations',
                '@yii/rbac/migrations/'
            ]
        ]
    ]
];
