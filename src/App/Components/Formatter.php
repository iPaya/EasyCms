<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Components;


use yii\di\Instance;
use yii\helpers\ArrayHelper;

class Formatter extends \yii\i18n\Formatter
{
    /**
     * @var string|DictManager|array
     */
    public $dictManager = 'dictManager';

    public function init()
    {
        parent::init();
        $this->dictManager = Instance::ensure($this->dictManager, DictManager::class);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function asUserStatus($value)
    {
        return $this->asDict($value, 'userStatuses');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function asCron($value)
    {
        return $this->asDict($value, 'cronCronSamples');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function asCronStatus($value)
    {
        return $this->asDict($value, 'cronStatus');
    }

    /**
     * @param string|int $value
     * @param string $code
     * @return mixed
     */
    public function asDict($value, $code)
    {
        $items = $this->dictManager->get($code);
        return ArrayHelper::getValue($items, $value);
    }

}
