<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

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
 * @property string $status 状态
 * @property int $createdAt
 * @property int $updatedAt
 */
class BaseUser extends \App\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nickname', 'email', 'passwordHash', 'passwordSalt', 'authKey', 'registeredAt'], 'required'],
            [['registeredAt', 'loginTimes', 'lastLoginAt', 'createdAt', 'updatedAt'], 'integer'],
            [['nickname', 'passwordHash', 'passwordSalt', 'authKey', 'status'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
            [['lastLoginIp'], 'string', 'max' => 15],
            [['nickname'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => '昵称',
            'email' => '邮箱',
            'passwordHash' => '加密密码',
            'passwordSalt' => '加密盐',
            'authKey' => '授权秘钥',
            'registeredAt' => '注册时间',
            'loginTimes' => '登录次数',
            'lastLoginIp' => 'Last Login Ip',
            'lastLoginAt' => '上次登录时间',
            'status' => '状态',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
