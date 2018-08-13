<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the model class for table "{{%file_dir}}".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $dir 目录
 * @property int $parentId 上级目录
 * @property int $createdAt
 * @property int $updatedAt
 */
class BaseFileDir extends \App\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%file_dir}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'dir'], 'required'],
            [['parentId', 'createdAt', 'updatedAt'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['dir'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'dir' => '目录',
            'parentId' => '上级目录',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
