<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\System;


class Module extends \EasyCms\Module
{
    public $controllerNamespace = 'App\Modules\Admin\Modules\System\Controllers';

    public function init()
    {
        $user = \Yii::$app->user;
        parent::init();
        $this->setMenu([
            //
            ['label' => '管理员管理', 'options' => ['class' => 'header'], 'visible' => $user->can('permission_manageManager')],
            ['label' => '管理员', 'url' => ['manager/index'], 'visible' => $user->can('permission_manageManager')],
            ['label' => '添加管理员', 'url' => ['manager/create'], 'visible' => $user->can('permission_manageManager')],
            //
            ['label' => '字典管理', 'options' => ['class' => 'header'], 'visible' => $user->can('permission_manageDict')],
            ['label' => '字典', 'url' => ['dict/index'], 'visible' => $user->can('permission_manageDict')],
            ['label' => '添加字典', 'url' => ['dict/create'], 'visible' => $user->can('permission_manageDict')],
            // 角色管理
            ['label' => '角色管理', 'options' => ['class' => 'header'], 'visible' => $user->can('permission_manageRbac')],
            ['label' => '角色', 'url' => ['role/index'], 'visible' => $user->can('permission_manageRbac')],
            ['label' => '添加角色', 'url' => ['role/create'], 'visible' => $user->can('permission_manageRbac')],
            // 权限管理
            ['label' => '权限管理', 'options' => ['class' => 'header'], 'visible' => $user->can('permission_manageRbac')],
            ['label' => '权限', 'url' => ['permission/index'], 'visible' => $user->can('permission_manageRbac')],
            ['label' => '添加权限', 'url' => ['permission/create'], 'visible' => $user->can('permission_manageRbac')],
        ]);
    }
}
