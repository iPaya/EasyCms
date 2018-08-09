<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\System\Models;


use yii\base\Model;

class RoleForm extends Model
{
    public $name;
    public $description;

    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            ['name', 'string', 'max' => 64],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'description' => '描述'
        ];
    }

    public function attributeHints()
    {
        return [
            'name' => '名称由系统自动生成'
        ];
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

        $authManager=  auth_manager();

        $role = $authManager->getRole($this->name);
        $isNew = false;
        if($role == null){
            $isNew = true;
            $role = $authManager->createRole($this->name);
        }
        $role->description = $this->description;

        if($isNew){
            return $authManager->add($role);
        }else{
            return $authManager->update($role->name,$role);
        }
    }
}
