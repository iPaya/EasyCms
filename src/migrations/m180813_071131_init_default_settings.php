<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\db\Migration;

/**
 * Class m180813_071131_init_default_settings
 */
class m180813_071131_init_default_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 网站设置
        settings()->set('name', '网站名称 EasyCms', 'site', 'string');
        settings()->set('keywords', '网站关键字', 'site', 'string');
        settings()->set('description', '网站描述', 'site', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        settings()->deleteAll();
    }

}
