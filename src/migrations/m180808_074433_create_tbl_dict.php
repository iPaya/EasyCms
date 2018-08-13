<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;

/**
 * Class m180808_074433_create_tbl_dict
 */
class m180808_074433_create_tbl_dict extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dict}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull()->unique()->comment('代码'),
            'name' => $this->string()->notNull()->unique()->comment('名称'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "字典表"');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dict}}');
    }

}
