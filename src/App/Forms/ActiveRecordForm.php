<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Forms;


use App\Db\ActiveRecord;
use yii\base\Model;

/**
 * Class ActiveRecordForm
 * @package App\Forms
 * @property ActiveRecord $activeRecord
 */
class ActiveRecordForm extends Model
{
    /**
     * @var ActiveRecord
     */
    private $_activeRecord;

    public static function from($activeRecord, $config = [])
    {
        $model = new static($config);
        $model->_activeRecord = $activeRecord;

        return $model;
    }

    /**
     * @return ActiveRecord
     */
    public function getActiveRecord()
    {
        return $this->_activeRecord;
    }
}
