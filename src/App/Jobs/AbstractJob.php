<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Jobs;


use yii\base\BaseObject;

abstract class AbstractJob extends BaseObject
{
    /**
     * 执行任务
     *
     * @return bool
     */
    abstract public function exec();
}
