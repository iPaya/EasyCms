<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

define('EASYCMS_ROOT', dirname(__DIR__));
defined('VENDOR_PATH') or define('VENDOR_PATH', EASYCMS_ROOT . '/vendor');
defined('DASHBOARD_RUNTIME_PATH') or define('DASHBOARD_RUNTIME_PATH', EASYCMS_ROOT . '/runtime');

require(VENDOR_PATH . '/autoload.php');
require(EASYCMS_ROOT . '/src/functions.php');

$dotenv = new Dotenv\Dotenv(EASYCMS_ROOT, '.env');
$dotenv->safeLoad();
$dotenv->required('DEBUG')
    ->isBoolean();
$dotenv->required([
    'ENV'
]);

if (in_array(strtolower(getenv('DEBUG')), ['1', 'on', 'true'])) {
    define('YII_DEBUG', true);
}

define('YII_ENV',getenv('ENV'));

require(VENDOR_PATH . '/yiisoft/yii2/Yii.php');

Yii::setAlias('@Root', EASYCMS_ROOT);
Yii::setAlias('@App', EASYCMS_ROOT . '/src/App');
Yii::setAlias('@EasyCms', EASYCMS_ROOT . '/src/EasyCms');
Yii::setAlias('@iPaya/Bootstrap', EASYCMS_ROOT . '/src/libs/Bootstrap');