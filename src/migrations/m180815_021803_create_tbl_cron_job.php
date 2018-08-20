<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;


/**
 * Class m180815_021803_create_tbl_cron_job
 */
class m180815_021803_create_tbl_cron_job extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cron_job}}', [
            'id' => $this->primaryKey(),
            'cronId' => $this->integer()->notNull()->comment('定时任务'),
            'jobClass' => $this->string(1000)->notNull()->comment('任务类'),
            'jobParams' => $this->text()->notNull()->comment('任务参数'),
            'status' => $this->string()->notNull()->comment('状态'),
            'log' => $this->text()->comment('任务日志'),
            'expectExecAt' => $this->integer()->comment('计划执行时间'),
            'execAt' => $this->integer()->comment('执行时间'),
            'endAt' => $this->integer()->comment('结束时间'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "定时任务 job 表"');

        $this->addForeignKey('fk-cron_job-cronId', '{{%cron_job}}', 'cronId', '{{%cron}}', 'id', 'cascade', 'cascade');
        $this->createIndex('idx-cron_job-status', '{{%cron_job}}', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-cron_job-cronId', '{{%cron_job}}');
        $this->dropTable('{{%cron_job}}');
    }
}
