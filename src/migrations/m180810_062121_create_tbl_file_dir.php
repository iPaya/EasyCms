<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;


/**
 * Class m180810_074521_init_file_dir
 */
class m180810_062121_create_tbl_file_dir extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file_dir}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('名称'),
            'dir' => $this->string(1000)->notNull()->comment('目录'),
            'parentId' => $this->integer()->notNull()->defaultValue(1)->comment('上级目录'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "文件目录"');

        $this->insert('{{%file_dir}}', [
            'id' => 1,
            'name' => '/',
            'dir' => '',
            'parentId' => 0,
            'createdAt' => time(),
            'updatedAt' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%file_dir}}');
    }

}
