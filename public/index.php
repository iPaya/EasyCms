<?php

require dirname(__DIR__) . '/src/bootstrap.php';

$config = \yii\helpers\ArrayHelper::merge(
    require(EASYCMS_ROOT . '/src/config/main.php'),
    require(EASYCMS_ROOT . '/src/config/web.php')
);

$app = new \yii\web\Application($config);
$app->run();