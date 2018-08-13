<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;

/**
 * Class m180808_074440_create_tbl_dict_item
 */
class m180808_074440_create_tbl_dict_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dict_item}}', [
            'id' => $this->primaryKey(),
            'dictId' => $this->integer()->notNull()->comment('字典 Id'),
            'name' => $this->string()->notNull()->comment('名称'),
            'value' => $this->string()->notNull()->comment('值'),
            'sortNo' => $this->integer()->notNull()->defaultValue(0)->comment('排序号'),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions() . ' comment "字典条目表"');

        $this->addForeignKey('fk-dict_item-dictId', '{{%dict_item}}', 'dictId', '{{%dict}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-dict_item-dictId', '{{%dict_item}}');
        $this->dropTable('{{%dict_item}}');
    }

}
