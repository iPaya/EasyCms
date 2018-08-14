<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;


/**
 * Class m180814_012826_create_tbl_user
 */
class m180814_012826_create_tbl_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'nickname' => $this->string()->notNull()->unique()->comment('昵称'),
            'email' => $this->string(100)->notNull()->unique()->comment('邮箱'),
            'passwordHash' => $this->string()->notNull()->comment('加密密码'),
            'passwordSalt' => $this->string()->notNull()->comment('加密盐'),
            'authKey' => $this->string()->notNull()->comment('授权秘钥'),
            'registeredAt' => $this->integer()->notNull()->comment('注册时间'),
            'loginTimes' => $this->integer()->notNull()->defaultValue(0)->comment('登录次数'),
            'lastLoginIp' => $this->string(15),
            'lastLoginAt' => $this->integer()->comment('上次登录时间'),
            'status' => $this->string()->notNull()->defaultValue('active')->comment('状态'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "用户表"');

        $this->createIndex('idx-user-status', '{{%user}}', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-user-status', '{{%user}}');
        $this->dropTable('{{%user}}');
    }

}
