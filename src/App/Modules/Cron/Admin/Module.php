<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Cron\Admin;


class Module extends \App\Module
{
    public $controllerNamespace = 'App\Modules\Cron\Admin\Controllers';

    public function init()
    {
        parent::init();

        $this->setMenu([
            ['label' => '定时任务', 'options' => ['class' => 'header']],
            ['label' => '所有定时任务', 'url' => ['cron/index']],
            ['label' => '添加定时任务', 'url' => ['cron/create']],
            // 队列
            ['label' => '消息队列', 'options' => ['class' => 'header']],
            ['label' => '所有消息队列', 'url' => ['queue/index']],
        ]);
    }
}
