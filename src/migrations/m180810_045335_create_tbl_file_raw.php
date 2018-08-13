<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;


/**
 * Class m180810_045335_create_tbl_file_raw
 */
class m180810_045335_create_tbl_file_raw extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file_raw}}', [
            'id' => $this->primaryKey(),
            'filename' => $this->string()->comment('文件名'),
            'hash' => $this->string(200)->notNull()->unique()->comment('Hash'),
            'mimeType' => $this->string()->notNull()->comment('Mime Type'),
            'size' => $this->integer()->notNull()->defaultValue(0)->comment('文件大小'),
            'path' => $this->string(2000)->notNull()->comment('路径'),
            'uploadDatetime' => $this->dateTime()->comment('上传时间'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "原始文件表"');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%file_raw}}');
    }
}
