<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Models;


use App\Models\Manager;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $verifyCode;

    private $_manager = false;

    public function attributeLabels()
    {
        return [
            'email' => '邮箱',
            'password' => '密码'
        ];
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['password', 'required'],
            ['password', 'validatePassword'],
            ['verifyCode', 'captcha', 'captchaAction' => '/' . admin_module()->id . '/default/captcha']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getManager();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '邮箱或密码错误.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getManager());
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Manager|null
     */
    public function getManager()
    {
        if ($this->_manager === false) {
            $this->_manager = Manager::find()->andWhere(['email' => $this->email])->one();
        }

        return $this->_manager;
    }
}