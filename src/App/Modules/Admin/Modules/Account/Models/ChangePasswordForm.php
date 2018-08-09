<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\Account\Models;


use App\Models\Manager;
use yii\base\InvalidConfigException;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $confirmPassword;

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
    }

    public function attributeLabels()
    {
        return [
            'oldPassword' => '旧密码',
            'newPassword' => '新密码',
            'confirmPassword' => '确认密码'
        ];
    }

    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'confirmPassword'], 'required'],
            ['oldPassword', 'validatePassword'],
            ['newPassword', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    public function validatePassword($attribute, $param)
    {
        if (!$this->manager->validatePassword($this->oldPassword)) {
            $this->addError('oldPassword', '旧密码不正确');
        }

    }

    /**
     * @return bool
     */
    public function changePassword()
    {
        if (!$this->validate()) {
            return false;
        }

        $manager = $this->manager;
        $manager->password = $this->newPassword;
        return $manager->save();
    }
}
