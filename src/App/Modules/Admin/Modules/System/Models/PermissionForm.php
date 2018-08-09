<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\System\Models;


use yii\base\Model;

class PermissionForm extends Model
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

        $permission = $authManager->getPermission($this->name);
        $isNew = false;
        if($permission == null){
            $isNew = true;
            $permission = $authManager->createPermission($this->name);
        }
        $permission->description = $this->description;

        if($isNew){
            return $authManager->add($permission);
        }else{
            return $authManager->update($permission->name,$permission);
        }
    }
}