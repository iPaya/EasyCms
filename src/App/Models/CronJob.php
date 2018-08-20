<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the model class for table "{{%cron_job}}".
 *
 * @property int $id
 * @property int $cronId 定时任务
 * @property string $jobClass 任务类
 * @property string $jobParams 任务参数
 * @property string $status 状态
 * @property string $log 任务日志
 * @property int $expectExecAt 计划执行时间
 * @property int $execAt 执行时间
 * @property int $endAt 结束时间
 * @property int $createdAt
 * @property int $updatedAt
 *
 * @property Cron $cron
 */
class CronJob extends BaseCronJob
{
    /**
     * {@inheritdoc}
     * @return CronJobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CronJobQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery|CronQuery
     */
    public function getCron()
    {
        return $this->hasOne(Cron::class, ['id' => 'cronId']);
    }
}
