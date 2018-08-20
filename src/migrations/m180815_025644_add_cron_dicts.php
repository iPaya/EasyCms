<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;
use App\Models\Dict;
use yii\db\conditions\InCondition;


/**
 * Class m180815_025644_add_cron_dicts
 */
class m180815_025644_add_cron_dicts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 创建文件类型字典
        if (!$this->createCronStatus()) {
            return false;
        }

        if (!$this->createCronCronSamples()) {
            return false;
        }
    }

    public function createCronStatus()
    {
        $code = 'cronStatus';
        $name = '定时任务状态';
        $dictItems = [
            ['name' => '开启', 'value' => 'enabled', 'sortNo' => 1],
            ['name' => '关闭', 'value' => 'disabled', 'sortNo' => 2],
        ];
        return Dict::create($code, $name, $dictItems);
    }

    public function createCronCronSamples()
    {
        $code = 'cronCronSamples';
        $name = '定时任务表达式示例';
        $dictItems = [
            ['name' => '每分钟', 'value' => '*/1 * * * *', 'sortNo' => 1],
            ['name' => '每小时', 'value' => '* */1 * * *', 'sortNo' => 2],
            ['name' => '每天', 'value' => '* * */1 * *', 'sortNo' => 3],
        ];
        return Dict::create($code, $name, $dictItems);
    }

    public function createCronJobStatus()
    {
        $code = 'cronJobStatus';
        $name = '定时任务 Job 状态';
        $dictItems = [
            ['name' => '挂起', 'value' => 'pending', 'sortNo' => 1],
            ['name' => '运行', 'value' => 'running', 'sortNo' => 2],
            ['name' => '成功', 'value' => 'success', 'sortNo' => 3],
            ['name' => '失败', 'value' => 'failed', 'sortNo' => 4],
        ];
        return Dict::create($code, $name, $dictItems);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Dict::deleteAll(new InCondition('code', 'IN', [
            'cronStatus',
            'cronJobStatus',
            'cronCronSamples',
        ]));
    }
}
