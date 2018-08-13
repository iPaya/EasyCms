<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\File;


class Module extends \App\Module
{
    public $controllerNamespace = 'App\Modules\Admin\Modules\File\Controllers';

    public function init()
    {
        parent::init();
        $this->setMenu([
            ['label' => '文件管理', 'url' => ['file/index']],
            ['label' => '图片', 'url' => ['image/index']],
        ]);
    }
}
