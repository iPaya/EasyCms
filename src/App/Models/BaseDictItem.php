<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

use Yii;

/**
 * This is the model class for table "{{%dict_item}}".
 *
 * @property int $id
 * @property int $dictId 字典 Id
 * @property string $name 名称
 * @property string $value 值
 * @property int $sortNo 排序号
 * @property int $createdAt
 * @property int $updatedAt
 */
class BaseDictItem extends \EasyCms\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dict_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dictId', 'name', 'value'], 'required'],
            [['dictId', 'sortNo', 'createdAt', 'updatedAt'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
            [['dictId'], 'exist', 'skipOnError' => true, 'targetClass' => Dict::className(), 'targetAttribute' => ['dictId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dictId' => '字典 Id',
            'name' => '名称',
            'value' => '值',
            'sortNo' => '排序号',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
