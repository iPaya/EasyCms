<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Components;


use App\Models\Dict;
use yii\base\Component;
use yii\caching\Cache;
use yii\di\Instance;

class DictManager extends Component
{
    const CACHE_ID = '__dict';
    /**
     * @var string|Cache|array
     */
    public $cache = 'cache';

    public function init()
    {
        parent::init();
        $this->cache = Instance::ensure($this->cache, Cache::class);
    }

    /**
     * @param string $code
     * @return array
     */
    public function get(string $code): array
    {
        $cache = $this->cache->get(self::CACHE_ID);
        if ($cache === false) {
            $cache = $this->reload();
        }

        return $cache[$code] ?? [];
    }

    /**
     * @return array
     */
    public function reload(): array
    {
        $this->clean();

        $cache = [];
        $models = Dict::find()->all();
        foreach ($models as $model) {
            $items = $model->getItems()->orderBy(['sortNo' => SORT_ASC])->all();
            foreach ($items as $item) {
                $cache[$model->code][$item->value] = $item->name;
            }
        }

        $this->cache->set(self::CACHE_ID, $cache, 3600);
        return $cache;
    }

    /**
     *
     */
    public function clean()
    {
        $this->cache->delete(self::CACHE_ID);
    }

}
