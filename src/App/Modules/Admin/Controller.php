<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin;


class Controller extends \App\Controller
{
    public function accessRules()
    {
        return [
            ['allow' => true, 'roles' => ['@']]
        ];
    }
}
