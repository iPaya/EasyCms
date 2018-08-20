<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Cron\Admin\Controllers;


use App\Modules\Cron\Admin\Controller;

class QueueController extends Controller
{
    public function actionIndex($page = 1)
    {
        $queue = queue();
        $pageSize = 20;
        $messages = $queue->lists($page, $pageSize);
        $count = $queue->count();
        $pages = ceil($count / $pageSize);
        $pages = $pages == 0 ? 1 : $pages;

        return $this->render('index', [
            'messages' => $messages,
            'count' => $count,
            'pageSize' => $pageSize,
            'page' => $page,
            'pages' => $pages,
        ]);
    }

}
