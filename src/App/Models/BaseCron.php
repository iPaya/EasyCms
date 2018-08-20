<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the model class for table "{{%cron}}".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $jobClass 任务类
 * @property string $jobParams 任务参数
 * @property string $cron Cron 表达式
 * @property string $status 状态
 * @property int $createdAt
 * @property int $updatedAt
 */
class BaseCron extends \App\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cron}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'jobClass', 'jobParams', 'cron', 'status'], 'required'],
            [['jobParams'], 'string'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['name', 'cron', 'status'], 'string', 'max' => 255],
            [['jobClass'], 'string', 'max' => 1000],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'jobClass' => '任务类',
            'jobParams' => '任务参数',
            'cron' => 'Cron 表达式',
            'status' => '状态',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
