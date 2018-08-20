<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Jobs;


class SayHelloJob extends AbstractJob
{
    public function exec()
    {
        echo 'Hello World!';
    }

}
