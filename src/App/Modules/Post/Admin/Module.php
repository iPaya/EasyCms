<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Post\Admin;


class Module extends \App\Module
{
    public $controllerNamespace = 'App\Modules\Post\Admin\Controllers';

    public function init()
    {
        parent::init();

        $this->setMenu([
            // 文章
            ['label' => '文章', 'options' => ['class' => 'header']],
            ['label' => '所有文章', 'url' => ['post/index']],
            ['label' => '添加文章', 'url' => ['post/create']],
            // 文章分类
            ['label' => '文章分类', 'options' => ['class' => 'header']],
            ['label' => '所有文章分类', 'url' => ['category/index']],
            ['label' => '添加文章分类', 'url' => ['category/create']],
        ]);
    }
}
