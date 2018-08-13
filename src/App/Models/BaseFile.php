<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property int $id
 * @property int $rawId 原始文件
 * @property int $dirId 目录
 * @property string $type 文件类型
 * @property string $uploadedDatetime 上传时间
 * @property int $createdAt
 * @property int $updatedAt
 */
class BaseFile extends \App\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rawId', 'dirId', 'type', 'uploadedDatetime'], 'required'],
            [['rawId', 'dirId', 'createdAt', 'updatedAt'], 'integer'],
            [['uploadedDatetime'], 'safe'],
            [['type'], 'string', 'max' => 100],
            [['dirId'], 'exist', 'skipOnError' => true, 'targetClass' => FileDir::className(), 'targetAttribute' => ['dirId' => 'id']],
            [['rawId'], 'exist', 'skipOnError' => true, 'targetClass' => FileRaw::className(), 'targetAttribute' => ['rawId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rawId' => '原始文件',
            'dirId' => '目录',
            'type' => '文件类型',
            'uploadedDatetime' => '上传时间',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
