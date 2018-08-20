<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Queue;


use yii\di\Instance;
use yii\redis\Connection;

class RedisQueue extends AbstractQueue
{
    /**
     * @var string
     */
    public $redisKey;

    /**
     * @var string|array|Connection
     */
    public $redis = 'redis';


    public function init()
    {
        parent::init();
        if ($this->redis == null) {
            $this->redis = param('redis.key') . ':queue';
        }
        $this->redis = Instance::ensure($this->redis, Connection::class);
    }

    /**
     * @param string $message
     * @return bool
     */
    public function pushMessage(string $message): bool
    {
        return $this->redis->rpush($this->redisKey, $message) > 0;
    }


    /**
     * @return string
     */
    public function popMessage(): string
    {
        return $this->redis->lpop($this->redisKey);
    }

    /**
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function lists(int $page, int $pageSize = 20): array
    {
        $start = ($page - 1) * $pageSize;
        $stop = $page * $pageSize;
        return $this->redis->lrange($this->redisKey, $start, $stop);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->redis->llen($this->redisKey);
    }
}
