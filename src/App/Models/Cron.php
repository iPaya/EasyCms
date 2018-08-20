<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

use App\Jobs\AbstractJob;
use yii\helpers\Json;

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
 *
 * @property CronJob[] $jobs
 */
class Cron extends BaseCron
{
    const EVENT_AFTER_ENABLE = 'afterEnable';
    const EVENT_AFTER_DISABLE = 'afterDisable';

    /**
     * {@inheritdoc}
     * @return CronQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CronQuery(get_called_class());
    }

    public function rules()
    {
        $rules = parent::rules();

        $rules[] = [['jobParams'], 'validateJobParams'];
        $rules[] = [['jobClass'], 'validateJobClass'];

        return $rules;
    }

    public function validateJobClass($attribute, $params)
    {
        try {
            $class = $this->jobClass;
            $obj = new $class();
            if (!$obj instanceof \App\Jobs\AbstractJob) {
                $this->addError($attribute, '不是 "\App\Jobs\AbstractJob" 的子类。');
            }
        } catch (\Throwable $exception) {
            $this->addError($attribute, $exception->getMessage());
        }
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateJobParams($attribute, $params)
    {
        try {
            $value = Json::decode($this->jobParams);
            if (!is_array($value)) {
                $this->addError($attribute, 'jobParams 必须为 json 数组格式。');
            }
        } catch (\Exception $exception) {
            $this->addError($attribute, $exception->getMessage());
        }
    }

    /**
     * @return \yii\db\ActiveQuery|CronJobQuery
     */
    public function getJobs()
    {
        return $this->hasMany(CronJob::class, ['cronId' => 'id']);
    }

    /**
     * @return array
     */
    public function attributeHints()
    {
        return [
            'jobClass' => '必须继承 <code>App\Jobs\AbstractJob</code>。',
        ];
    }

    /**
     * @return bool
     */
    public function getIsEnabled(): bool
    {
        return $this->status == 'enabled';
    }

    /**
     * 创建计划任务 Job 对象
     *
     * @return CronJob
     */
    public function createCronJob()
    {
        return new CronJob([
            'cronId' => $this->id,
            'jobClass' => $this->jobClass,
            'jobParams' => $this->jobParams,
            'status' => 'pending',
            'expectExecAt' => $this->getNextExecAt(),
        ]);
    }

    /**
     * @return int
     */
    public function getNextExecAt(): int
    {
        return 0;
    }

    /**
     * @return AbstractJob
     */
    public function createJob()
    {
        $jobClass = $this->jobClass;
        $jobParams = $this->getJobParams();

        return new $jobClass($jobParams);
    }

    /**
     * @return array
     */
    public function getJobParams()
    {
        return Json::decode($this->jobParams);
    }

    /**
     * @return bool
     */
    public function enable()
    {
        $this->status = 'enabled';
        if (!$this->validate()) {
            return false;
        }

        $tr = self::getDb()->beginTransaction();
        try {
            if (!$this->save(false)) {
                return false;
            }

            $this->afterEnable();
            $tr->commit();
            return true;
        } catch (\Exception  $exception) {
            $tr->rollBack();
            return false;
        }
        return false;
    }

    /**
     *
     */
    public function afterEnable()
    {
        $this->trigger(self::EVENT_AFTER_ENABLE);
    }

    /**
     * @return bool
     */
    public function disable()
    {
        $this->status = 'disabled';
        if (!$this->validate()) {
            return false;
        }

        $tr = self::getDb()->beginTransaction();
        try {
            if (!$this->save(false)) {
                return false;
            }

            $this->afterDisable();
            $tr->commit();
            return true;
        } catch (\Exception  $exception) {
            $tr->rollBack();
            return false;
        }
        return false;
    }

    /**
     *
     */
    public function afterDisable()
    {
        $this->trigger(self::EVENT_AFTER_DISABLE);
    }
}
