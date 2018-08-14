<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\User\Admin\Models;


use App\Models\User;
use yii\base\Model;

class CreateUserForm extends Model
{
    public $nickname;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['nickname', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => 5, 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nickname' => '昵称',
            'email' => '邮箱',
            'password' => '密码'
        ];
    }

    /**
     * @return bool|User
     * @throws \yii\base\Exception
     */
    public function create()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User([
            'nickname' => $this->nickname,
            'email' => $this->email,
        ]);

        $user->authKey = \Yii::$app->security->generateRandomString();
        $user->setPassword($this->password);

        if (!$user->register()) {
            return false;
        }

        return $user;
    }
}
