<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Queue;


use App\Jobs\AbstractJob;
use yii\base\Component;

abstract class AbstractQueue extends Component
{
    /**
     * @param AbstractJob $job
     * @return bool
     */
    public function push(AbstractJob $job): bool
    {
        $message = serialize($job);
        return $this->pushMessage($message);
    }

    /**
     * @param string $message
     * @return bool
     */
    abstract public function pushMessage(string $message): bool;

    /**
     * @return AbstractJob
     */
    public function pop(): AbstractJob
    {
        return unserialize($this->popMessage());
    }

    /**
     * @return string
     */
    abstract public function popMessage(): string;

    /**
     * @return int
     */
    abstract public function count(): int;

    /**
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    abstract public function lists(int $page, int $pageSize = 20): array;
}
