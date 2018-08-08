<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin;


class Module extends \EasyCms\Module
{
    public $layout = 'main';
    public $controllerNamespace = 'App\Modules\Admin\Controllers';

    public function getNav(): array
    {
        return [
            ['label' => '系统管理', 'url' => module_url($this, ['system/manager/index']), 'active' => ('system' == current_module()->id)],
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
            ]
        ]);
        \Yii::$app->set('user', [
            'class' => 'yii\web\User',
            'identityClass' => 'App\Models\Manager',
            'idParam' => 'adminId',
            'loginUrl' => ['/' . getenv('ADMIN_MODULE') . '/default/login']

        ]);
    }
}