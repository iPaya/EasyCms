<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Models\Dict;
use yii\db\conditions\InCondition;
use yii\db\Migration;

/**
 * Class m180814_011628_add_dict_user_status
 */
class m180814_011628_add_dict_user_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $code = 'userStatuses';
        $name = '用户状态';
        $dictItems = [
            ['name' => '激活', 'value' => 'active', 'sortNo' => 1],
            ['name' => '锁定', 'value' => 'locked', 'sortNo' => 2],
        ];
        return Dict::create($code, $name, $dictItems);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Dict::deleteAll(new InCondition('code', 'IN', [
            'userStatuses',
        ]));
    }

}
