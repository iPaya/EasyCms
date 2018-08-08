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
        parent::init();
        $this->setMenu([
            ['label' => '管理员管理', 'url' =>[ 'manager/index']],
            ['label' => '添加管理员', 'url' =>[ 'manager/create']],
        ]);
    }
}