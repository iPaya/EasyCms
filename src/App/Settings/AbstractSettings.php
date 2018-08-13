<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Settings;


use yii\base\Model;

abstract class AbstractSettings extends Model
{
    /**
     * @return string
     */
    abstract public static function title(): string;

    /**
     * @return static
     */
    public static function getInstance()
    {
        $instance = new static();
        $attributes = $instance->attributes();
        foreach ($attributes as $attribute) {
            $instance->{$attribute} = settings_value($attribute, static::class);
        }
        return $instance;
    }

    /**
     * @return bool
     */
    public function save()
    {
        $settings = settings();
        foreach ($this->toArray() as $key => $value) {
            $settings->set($key, $value, static::sectionName(), 'string');
        }
        return true;
    }

    /**
     * @return string
     */
    abstract public static function sectionName(): string;
}
