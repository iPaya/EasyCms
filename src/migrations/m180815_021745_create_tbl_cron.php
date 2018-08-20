<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;


/**
 * Class m180815_021745_create_tbl_cron
 */
class m180815_021745_create_tbl_cron extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cron}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->comment('名称'),
            'jobClass' => $this->string(1000)->notNull()->comment('任务类'),
            'jobParams' => $this->text()->notNull()->comment('任务参数'),
            'cron' => $this->string()->notNull()->comment('Cron 表达式'),
            'status' => $this->string()->notNull()->comment('状态'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "定时任务表"');

        $this->createIndex('idx-cron-status', '{{%cron}}', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cron}}');
    }

}
