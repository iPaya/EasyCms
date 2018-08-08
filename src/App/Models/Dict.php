<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

use Yii;

/**
 *
 * @property int $id
 * @property string $code 代码
 * @property string $name 名称
 * @property int $createdAt
 * @property int $updatedAt
 * @property DictItem[] $items
 */
class Dict extends BaseDict
{
    /**
     * {@inheritdoc}
     * @return DictQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DictQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery|DictItemQuery
     */
    public function getItems()
    {
        return $this->hasMany(DictItem::class,[
            'dictId'=>'id'
        ]);
    }
}
