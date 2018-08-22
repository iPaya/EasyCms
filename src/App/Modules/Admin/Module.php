<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin;


class Module extends \App\Module
{
    public $layout = 'main';
    public $controllerNamespace = 'App\Modules\Admin\Controllers';

    public function getNav(): array
    {
        $user = \Yii::$app->user;
        return [
            [
                'label' => '文章',
                'url' => module_url($this, ['post/post/index']),
                'active' => ('post' == current_module()->id),
                'visible' => (
                $user->can('permission_managePost')
                ),
            ],
            [
                'label' => '文件',
                'url' => module_url($this, ['file/file/index']),
                'active' => ('file' == current_module()->id),
                'visible' => (
                $user->can('permission_manageFile')
                ),
            ],
            [
                'label' => '系统',
                'url' => module_url($this, ['system/default/index']),
                'active' => ('system' == current_module()->id),
                'visible' => (
                    $user->can('permission_manageRbac') ||
                    $user->can('permission_manageManager') ||
                    $user->can('permission_manageDict')
                ),
            ],
            [
                'label' => '设置',
                'url' => module_url($this, ['settings/settings/site']),
                'active' => ('settings' == current_module()->id),
                'visible' => (
                $user->can('permission_manageSettings')
                ),
            ],
            [
                'label' => '用户',
                'url' => module_url($this, ['user/user/index']),
                'active' => ('user' == current_module()->id),
                'visible' => (
                $user->can('permission_manageUser')
                ),
            ],
            [
                'label' => '定时任务',
                'url' => module_url($this, ['cron/cron/index']),
                'active' => ('cron' == current_module()->id),
                'visible' => (
                $user->can('permission_manageCron')
                ),
            ],
        ];
    }

    public function getMenu(): array
    {
        return parent::getMenu();
    }

    public function init()
    {
        parent::init();
        $this->setModules([
            'system' => [
                'class' => 'App\Modules\Admin\Modules\System\Module',
            ],
            'account' => [
                'class' => 'App\Modules\Admin\Modules\Account\Module',
            ],
            'file' => [
                'class' => 'App\Modules\Admin\Modules\File\Module',
            ],
            'settings' => [
                'class' => 'App\Modules\Admin\Modules\Settings\Module'
            ],
            'user' => [
                'class' => 'App\Modules\User\Admin\Module'
            ],
            'cron' => [
                'class' => 'App\Modules\Cron\Admin\Module'
            ],
            'post' => [
                'class' => 'App\Modules\Post\Admin\Module'
            ],
        ]);
        \Yii::$app->set('user', [
            'class' => 'yii\web\User',
            'identityClass' => 'App\Models\Manager',
            'idParam' => 'adminId',
            'loginUrl' => ['/' . getenv('ADMIN_MODULE') . '/default/login']
        ]);
    }
}
