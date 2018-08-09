<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\System\Models;


use yii\base\Model;

class RoleForm extends Model
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $name;
    public $description;
    private $isNewRecord = true;

    /**
     * @return bool
     */
    public function getIsNewRecord(): bool
    {
        return $this->isNewRecord;
    }

    /**
     * @param bool $isNewRecord
     */
    public function setIsNewRecord(bool $isNewRecord): void
    {
        $this->isNewRecord = $isNewRecord;
    }

    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            ['name', 'string', 'max' => 64],
            ['name', 'validateName', 'on' => self::SCENARIO_CREATE],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'description' => '描述'
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['name', 'description'],
            self::SCENARIO_UPDATE => ['description'],
        ];
    }

    public function validateName($attribute, $param)
    {
        if (auth_manager()->getRole($this->name) != null) {
            $this->addError('name', "{$this->name} 已经存在.");
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $authManager = auth_manager();

        $role = $authManager->getRole($this->name);
        if ($role == null) {
            $role = $authManager->createRole($this->name);
        }
        $role->description = $this->description;

        if ($this->getIsNewRecord()) {
            return $authManager->add($role);
        } else {
            return $authManager->update($role->name, $role);
        }
    }
}
