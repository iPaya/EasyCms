<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;


/**
 * Class m180810_062249_create_tbl_file
 */
class m180810_062249_create_tbl_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'rawId' => $this->integer()->notNull()->comment('原始文件'),
            'dirId' => $this->integer()->notNull()->comment('目录'),
            'type' => $this->string(100)->notNull()->comment('文件类型'),
            'uploadedDatetime' => $this->dateTime()->notNull()->comment('上传时间'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "文件表"');

        $this->addForeignKey('fk-file-rawId', '{{%file}}', 'rawId', '{{%file_raw}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-file-dirId', '{{%file}}', 'dirId', '{{%file_dir}}', 'id', 'cascade', 'cascade');
        $this->createIndex('idx-file-type', '{{%file}}', 'type');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-file-rawId', '{{%file}}');
        $this->dropForeignKey('fk-file-dirId', '{{%file}}');
        $this->dropTable('{{%file}}');
    }

}
