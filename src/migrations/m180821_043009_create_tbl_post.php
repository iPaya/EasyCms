<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;


/**
 * Class m180821_043009_create_tbl_post
 */
class m180821_043009_create_tbl_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'categoryId' => $this->integer()->notNull()->comment('分类'),
            'title' => $this->string(200)->notNull()->comment('标题'),
            'content' => $this->text()->comment('内容'),
            'visitCount' => $this->integer()->notNull()->defaultValue(0)->comment('浏览量'),
            'editor' => $this->string()->comment('编辑'),
            'author' => $this->string()->comment('作者'),
            'status' => $this->string()->notNull()->comment('状态'),
            'publishedAt' => $this->integer(),
            'type' => $this->string()->notNull()->comment('文章类型'),
            'original' => $this->string()->comment('来源'),
            'originalUrl' => $this->string()->comment('来源文章地址'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "文章表"');

        $this->addForeignKey('fk-post-categoryId', '{{%post}}', 'categoryId', '{{%post_category}}', 'id');
        $this->createIndex('idx-post-status', '{{%post}}', 'status');
        $this->createIndex('idx-post-type', '{{%post}}', 'type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-post-categoryId', '{{%post}}');
        $this->dropTable('{{%post}}');
    }

}
