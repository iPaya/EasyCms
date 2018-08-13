<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\Account;


class Module extends \App\Module
{
    public $controllerNamespace = 'App\Modules\Admin\Modules\Account\Controllers';

    public function init()
    {
        parent::init();
        $this->setMenu([
            //
            ['label' => '个人资料', 'url' => ['profile/index']],
            ['label' => '修改密码', 'url' => ['security/change-password']],
        ]);
    }
}
