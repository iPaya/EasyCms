<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

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
     * @param string $code
     * @param string $name
     * @param array $items
     * @return bool
     */
    public static function create(string $code, string $name, $items = []): bool
    {
        $dict = new Dict([
            'code' => $code,
            'name' => $name
        ]);
        if (!$dict->save()) {
            return false;
        }
        foreach ($items as $item) {
            $dictItem = new DictItem([
                'dictId' => $dict->id,
                'name' => $item['name'],
                'value' => $item['value'],
                'sortNo' => $item['sortNo'],
            ]);
            if (!$dictItem->save()) {
                return false;
            }
        }
        dict_manager()->reload();
        return true;
    }

    /**
     * @return \yii\db\ActiveQuery|DictItemQuery
     */
    public function getItems()
    {
        return $this->hasMany(DictItem::class, [
            'dictId' => 'id'
        ]);
    }
}
