<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the model class for table "{{%file_raw}}".
 *
 * @property int $id
 * @property string $filename 文件名
 * @property string $hash Hash
 * @property string $mimeType Mime Type
 * @property int $size 文件大小
 * @property string $path 路径
 * @property string $uploadDatetime 上传时间
 * @property int $createdAt
 * @property int $updatedAt
 */
class BaseFileRaw extends \App\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%file_raw}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hash', 'mimeType', 'path'], 'required'],
            [['size', 'createdAt', 'updatedAt'], 'integer'],
            [['uploadDatetime'], 'safe'],
            [['filename', 'mimeType'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 200],
            [['path'], 'string', 'max' => 2000],
            [['hash'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => '文件名',
            'hash' => 'Hash',
            'mimeType' => 'Mime Type',
            'size' => '文件大小',
            'path' => '路径',
            'uploadDatetime' => '上传时间',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
