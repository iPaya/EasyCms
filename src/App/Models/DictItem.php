<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the model class for table "{{%dict_item}}".
 *
 * @property int $id
 * @property int $dictId 字典 Id
 * @property string $name 名称
 * @property string $value 值
 * @property int $createdAt
 * @property int $updatedAt
 */
class DictItem extends BaseDictItem
{

    /**
     * {@inheritdoc}
     * @return DictItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DictItemQuery(get_called_class());
    }
}
