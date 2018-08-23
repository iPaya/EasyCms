<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Queue;


use App\Jobs\AbstractJob;
use App\Models\CronJob;
use yii\base\Component;

abstract class AbstractQueue extends Component
{
    /**
     * @param CronJob $cronJob
     * @return bool
     */
    public function push(CronJob $cronJob): bool
    {
        $message = serialize($cronJob);
        return $this->pushMessage($message);
    }

    /**
     * @param string $message
     * @return bool
     */
    abstract public function pushMessage(string $message): bool;

    /**
     * @return CronJob|null
     */
    public function pop(): ?AbstractJob
    {
        $message = $this->popMessage();
        if ($message == null) {
            return $message;
        }
        return unserialize($message);
    }

    /**
     * @return string|null
     */
    abstract public function popMessage(): ?string;

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
