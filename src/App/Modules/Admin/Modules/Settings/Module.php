<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\Settings;


class Module extends \App\Module
{
    public $controllerNamespace = 'App\Modules\Admin\Modules\Settings\Controllers';

    public function init()
    {
        parent::init();
        $this->setMenu([
            ['label' => '基本信息', 'options' => ['class' => 'header']],
            ['label' => '站点信息', 'url' => ['settings/site']],
            ['label' => '邮件设置', 'url' => ['settings/mail']],
            ['label' => '嵌入代码', 'url' => ['settings/code']],
        ]);
    }
}
