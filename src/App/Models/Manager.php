<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

use EasyCms\Helpers\PasswordHelper;
use yii\web\IdentityInterface;

/**
 */
class Manager extends BaseManager implements IdentityInterface
{
    public $password;

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['password'] = '密码';
        return $labels;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['password', 'required', 'on' => 'create'];
        $rules[] = ['password', 'safe'];
        return $rules;
    }

    public function beforeValidate()
    {
        if ($this->authKey == null) {
            $this->authKey = \Yii::$app->security->generateRandomString();
        }
        if ($this->password) {
            $this->passwordHash = PasswordHelper::generateHash($this->password,password_salt());
        }
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     * @return ManagerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ManagerQuery(get_called_class());
    }

    /**
     * @inheritDoc
     * @return Manager
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return PasswordHelper::validatePassword($password, $this->passwordHash, password_salt());
    }
}
