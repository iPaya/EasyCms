<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;
use App\Models\Dict;
use yii\db\conditions\InCondition;


/**
 * Class m180821_051724_add_post_dicts
 */
class m180821_051724_add_post_dicts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if (!$this->createPostStatus()) {
            return false;
        }

        if (!$this->createPostTypes()) {
            return false;
        }
    }

    public function createPostStatus()
    {
        $code = 'postStatus';
        $name = '文章状态';
        $dictItems = [
            ['name' => '草稿', 'value' => 'draft', 'sortNo' => 1],
            ['name' => '发布', 'value' => 'published', 'sortNo' => 2],
            ['name' => '删除', 'value' => 'deleted', 'sortNo' => 3],
        ];
        return Dict::create($code, $name, $dictItems);
    }

    public function createPostTypes()
    {
        $code = 'postType';
        $name = '文章类型';
        $dictItems = [
            ['name' => '原创', 'value' => 'original', 'sortNo' => 1],
            ['name' => '转载', 'value' => 'repost', 'sortNo' => 2],
        ];
        return Dict::create($code, $name, $dictItems);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Dict::deleteAll(new InCondition('code', 'IN', [
            'postStatus',
            'postTypes',
        ]));
    }
}
