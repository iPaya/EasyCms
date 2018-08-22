<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the model class for table "{{%post_category}}".
 *
 * @property int $id
 * @property string $name 名称
 * @property int $parentId 上级分类
 * @property int $createdAt
 * @property int $updatedAt
 */
class BasePostCategory extends \App\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parentId', 'createdAt', 'updatedAt'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'parentId' => '上级分类',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
