<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the ActiveQuery class for [[DictItem]].
 *
 * @see DictItem
 */
class DictItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DictItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DictItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
