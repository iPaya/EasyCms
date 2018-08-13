<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the model class for table "{{%dict}}".
 *
 * @property int $id
 * @property string $code 代码
 * @property string $name 名称
 * @property int $createdAt
 * @property int $updatedAt
 */
class BaseDict extends \App\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dict}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => '代码',
            'name' => '名称',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
