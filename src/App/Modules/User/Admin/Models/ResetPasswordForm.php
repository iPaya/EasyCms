<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\User\Admin\Models;


use App\Forms\ActiveRecordForm;
use App\Models\User;

/**
 * Class ResetPasswordForm
 * @package App\Modules\User\Admin\Models
 * @property User $activeRecord
 */
class ResetPasswordForm extends ActiveRecordForm
{

    public $password;

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '密码'
        ];
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function resetPassword()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = $this->activeRecord;
        $user->setPassword($this->password);

        return $user->save();
    }
}
