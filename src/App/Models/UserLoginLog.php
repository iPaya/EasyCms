<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the model class for table "{{%user_login_log}}".
 *
 * @property int $id
 * @property int $userId 用户
 * @property string $loginIp 登录 IP
 * @property int $loginAt 登录时间
 * @property string $userAgent User Agent
 * @property int $times 登录次第
 * @property int $createdAt
 * @property int $updatedAt
 *
 * @property User $user
 */
class UserLoginLog extends BaseUserLoginLog
{
    /**
     * {@inheritdoc}
     * @return UserLoginLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserLoginLogQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }
}
