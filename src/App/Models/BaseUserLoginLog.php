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
 */
class BaseUserLoginLog extends \App\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_login_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'times'], 'required'],
            [['userId', 'loginAt', 'times', 'createdAt', 'updatedAt'], 'integer'],
            [['loginIp'], 'string', 'max' => 15],
            [['userAgent'], 'string', 'max' => 500],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => '用户',
            'loginIp' => '登录 IP',
            'loginAt' => '登录时间',
            'userAgent' => 'User Agent',
            'times' => '登录次第',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
