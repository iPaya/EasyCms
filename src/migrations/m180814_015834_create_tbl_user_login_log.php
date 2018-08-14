<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;


/**
 * Class m180814_015834_create_tbl_user_login_log
 */
class m180814_015834_create_tbl_user_login_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_login_log}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull()->comment('用户'),
            'loginIp' => $this->string(15)->comment('登录 IP'),
            'loginAt' => $this->integer()->comment('登录时间'),
            'userAgent' => $this->string(500)->comment('User Agent'),
            'times' => $this->integer()->notNull()->comment('登录次第'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "用户登录日志"');

        $this->addForeignKey('fk-user_login_log-userId', '{{%user_login_log}}', 'userId', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_login_log-userId', '{{%user_login_log}}');
        $this->dropTable('{{%user_login_log}}');
    }

}
