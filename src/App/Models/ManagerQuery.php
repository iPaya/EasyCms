<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the ActiveQuery class for [[Admin]].
 *
 * @see Manager
 */
class ManagerQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Manager[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Manager|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
