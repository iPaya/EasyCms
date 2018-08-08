<?php

use EasyCms\Components\Migration;
use EasyCms\Helpers\PasswordHelper;


/**
 * Class m180808_054509_create_tbl_manager
 */
class m180808_054509_create_tbl_manager extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%manager}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('姓名'),
            'email' => $this->string()->notNull()->unique()->comment('邮箱'),
            'passwordHash' => $this->string()->notNull()->comment('加密密码'),
            'authKey' => $this->string()->comment('AuthKey'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "管理员表"');

        $this->insert('{{%manager}}', [
            'id' => 1,
            'name' => '管理员',
            'email' => 'admin@example.com',
            'passwordHash' => PasswordHelper::generateHash('123456', password_salt()),
            'authKey' => Yii::$app->security->generateRandomString(),
            'createdAt' => time(),
            'updatedAt' => time(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%manager}}');
    }

}
