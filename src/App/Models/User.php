<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

use App\Helpers\PasswordHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $nickname 昵称
 * @property string $email 邮箱
 * @property string $passwordHash 加密密码
 * @property string $passwordSalt 加密盐
 * @property string $authKey 授权秘钥
 * @property int $registeredAt 注册时间
 * @property int $loginTimes 登录次数
 * @property string $lastLoginIp
 * @property int $lastLoginAt 上次登录时间
 * @property int $createdAt
 * @property int $updatedAt
 *
 * @property UserLoginLog[] $loginLogs
 */
class User extends BaseUser implements IdentityInterface
{
    const EVENT_AFTER_REGISTER = 'afterRegister';
    const EVENT_AFTER_LOCK = 'afterLock';
    const EVENT_AFTER_ACTIVE = 'afterActive';

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * @return \yii\db\ActiveQuery|UserLoginLogQuery
     */
    public function getLoginLogs()
    {
        return $this->hasMany(UserLoginLog::class, ['userId' => 'id']);
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->status == 'active';
    }

    /**
     * @return bool
     */
    public function getIsLocked()
    {
        return $this->status == 'locked';
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey): bool
    {
        return $authKey === $this->authKey;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        return PasswordHelper::validatePassword($password, $this->passwordHash, $this->passwordSalt);
    }

    /**
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword(string $password): void
    {
        $this->passwordSalt = \Yii::$app->security->generateRandomString();
        $this->passwordHash = PasswordHelper::generateHash($password, $this->passwordSalt);
    }

    public function register()
    {
        $this->registeredAt = time();

        if (!$this->validate()) {
            return false;
        }

        $tr = self::getDb()->beginTransaction();
        try {
            if (!$this->save(false)) {
                return false;
            }

            $this->afterRegister();
            $tr->commit();
            return true;
        } catch (\Exception  $exception) {
            $tr->rollBack();
            return false;
        }
        return false;
    }

    /**
     *
     */
    public function afterRegister(): void
    {
        $this->trigger(self::EVENT_AFTER_REGISTER);
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function active()
    {
        $this->status = 'active';

        if (!$this->validate()) {
            return false;
        }

        $tr = self::getDb()->beginTransaction();
        try {
            if (!$this->save(false)) {
                return false;
            }

            $this->afterActive();
            $tr->commit();
            return true;
        } catch (\Exception  $exception) {
            $tr->rollBack();
            return false;
        }
        return false;
    }

    /**
     *
     */
    public function afterActive()
    {
        $this->trigger(self::EVENT_AFTER_ACTIVE);
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function lock()
    {
        $this->status = 'locked';

        if (!$this->validate()) {
            return false;
        }

        $tr = self::getDb()->beginTransaction();
        try {
            if (!$this->save(false)) {
                return false;
            }

            $this->afterLock();
            $tr->commit();
            return true;
        } catch (\Exception  $exception) {
            $tr->rollBack();
            return false;
        }
        return false;
    }

    /**
     *
     */
    public function afterLock()
    {
        $this->trigger(self::EVENT_AFTER_LOCK);
    }
}
