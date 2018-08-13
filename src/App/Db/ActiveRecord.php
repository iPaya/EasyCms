<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Db;


use yii\behaviors\TimestampBehavior;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => TimestampBehavior::class,
            'createdAtAttribute' => $this->hasAttribute('createdAt') ? 'createdAt' : false,
            'updatedAtAttribute' => $this->hasAttribute('updatedAt') ? 'updatedAt' : false,
            'value' => time(),
        ];
        return $behaviors;
    }
}
