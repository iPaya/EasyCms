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
 */
class BaseCronJob extends \App\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cron_job}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cronId', 'jobClass', 'jobParams', 'status'], 'required'],
            [['cronId', 'expectExecAt', 'execAt', 'endAt', 'createdAt', 'updatedAt'], 'integer'],
            [['jobParams', 'log'], 'string'],
            [['jobClass'], 'string', 'max' => 1000],
            [['status'], 'string', 'max' => 255],
            [['cronId'], 'exist', 'skipOnError' => true, 'targetClass' => Cron::className(), 'targetAttribute' => ['cronId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cronId' => '定时任务',
            'jobClass' => '任务类',
            'jobParams' => '任务参数',
            'status' => '状态',
            'log' => '任务日志',
            'expectExecAt' => '计划执行时间',
            'execAt' => '执行时间',
            'endAt' => '结束时间',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
