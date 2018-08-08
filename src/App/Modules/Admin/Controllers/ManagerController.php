<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Controllers;


use App\Modules\Admin\Controller;

class ManagerController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}