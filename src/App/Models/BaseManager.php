<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

use Yii;

/**
 * This is the model class for table "{{%manager}}".
 *
 * @property int $id
 * @property string $name 姓名
 * @property string $email 邮箱
 * @property string $passwordHash 加密密码
 * @property string $authKey AuthKey
 * @property int $createdAt
 * @property int $updatedAt
 */
class BaseManager extends \EasyCms\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%manager}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'passwordHash'], 'required'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['name', 'email', 'passwordHash', 'authKey'], 'string', 'max' => 255],
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
            'name' => '姓名',
            'email' => '邮箱',
            'passwordHash' => '加密密码',
            'authKey' => 'AuthKey',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
