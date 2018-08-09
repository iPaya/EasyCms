<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\Account\Models;


use App\Models\Manager;
use yii\base\InvalidConfigException;
use yii\base\Model;

class ProfileForm extends Model
{
    public $name;

    /**
     * @var Manager
     */
    public $manager;

    public function init()
    {
        parent::init();
        if ($this->manager == null) {
            throw new InvalidConfigException('请配置 "manager"');
        }

        $this->name = $this->manager->name;
    }

    public function rules()
    {
        return [
            ['name', 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '姓名'
        ];
    }

    /**
     * @return bool
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $manager = $this->manager;
        $manager->name = $this->name;

        return $manager->save();
    }
}
