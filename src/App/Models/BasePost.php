<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property int $categoryId 分类
 * @property string $title 标题
 * @property string $content 内容
 * @property int $visitCount 浏览量
 * @property string $editor 编辑
 * @property string $author 作者
 * @property string $status 状态
 * @property int $publishedAt
 * @property string $type 文章类型
 * @property string $original 来源
 * @property string $originalUrl 来源文章地址
 * @property int $createdAt
 * @property int $updatedAt
 */
class BasePost extends \App\Db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoryId', 'title', 'status', 'type'], 'required'],
            [['categoryId', 'visitCount', 'publishedAt', 'createdAt', 'updatedAt'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 200],
            [['editor', 'author', 'status', 'type', 'original', 'originalUrl'], 'string', 'max' => 255],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => PostCategory::className(), 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryId' => '分类',
            'title' => '标题',
            'content' => '内容',
            'visitCount' => '浏览量',
            'editor' => '编辑',
            'author' => '作者',
            'status' => '状态',
            'publishedAt' => 'Published At',
            'type' => '文章类型',
            'original' => '来源',
            'originalUrl' => '来源文章地址',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
