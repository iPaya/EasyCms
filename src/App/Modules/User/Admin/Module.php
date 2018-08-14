<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\User\Admin;


class Module extends \App\Module
{
    public $controllerNamespace = 'App\Modules\User\Admin\Controllers';

    public function init()
    {
        parent::init();

        $this->setMenu([
            ['label' => '所有用户', 'url' => ['user/index']],
            ['label' => '添加用户', 'url' => ['user/create']],
        ]);
    }


}
