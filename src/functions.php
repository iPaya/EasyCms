<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\AlertManager;
use App\Components\DictManager;
use App\Module;
use League\Flysystem\Filesystem;
use pheme\settings\components\Settings;
use yii\helpers\ArrayHelper;
use yii\rbac\ManagerInterface;

/**
 * @return string
 */
function admin_name()
{
    return param('admin.name', 'EasyAdmin 管理平台');
}

/**
 * @return string
 */
function password_salt()
{
    return param('password.salt');
}

/**
 * @param string $name
 * @param null $defaultValue
 * @return mixed
 */
function param(string $name, $defaultValue = null)
{
    return ArrayHelper::getValue(Yii::$app->params, $name, $defaultValue);
}

/**
 * @return \yii\base\Module|Module|null
 */
function current_module()
{
    return Yii::$app->controller->module;
}

/**
 * @param \yii\base\Module $module
 * @param array $url
 * @return array
 */
function module_url(\yii\base\Module $module, array $url)
{
    $route = $url[0];

    if (substr($route, 0, 1) != '/') {
        $route = $module->id . '/' . $route;
        $url[0] = '/' . $route;
    }

    return $url;
}

/**
 * @param $id
 * @return null|\yii\base\Module
 */
function module($id)
{
    return Yii::$app->getModule($id);
}

/**
 * @return null|\yii\base\Module
 */
function admin_module()
{
    return \module(getenv('ADMIN_MODULE'));
}

/**
 * @return DictManager
 */
function dict_manager()
{
    return Yii::$app->get('dictManager');
}

/**
 * @return ManagerInterface
 */
function auth_manager()
{
    return Yii::$app->get('authManager');
}

/**
 * @return Filesystem
 */
function file_system()
{
    return Yii::$app->get('fileSystem')->getFileSystem();
}

/**
 * @param $value
 * @param $format
 * @return string
 */
function format($value, $format)
{
    return Yii::$app->formatter->format($value, $format);
}

/**
 * @return Settings
 */
function settings()
{
    return Yii::$app->get('settings');
}

/**
 * @param string $key
 * @param \App\Settings\AbstractSettings|string $settingsClass
 * @return string
 */
function settings_value($key, $settingsClass)
{
    return \settings()->get($settingsClass::sectionName() . '.' . $key);
}

/**
 * @return AlertManager
 * @throws \yii\base\InvalidConfigException
 */
function alert_manager()
{
    return Yii::$app->get('alertManager');
}
