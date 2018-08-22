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
 *
 * @property PostCategory $category
 */
class Post extends BasePost
{
    /**
     * {@inheritdoc}
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    public function rules()
    {
        $rules = parent::rules();

        $rules[] = ['originalUrl', 'url'];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        if ($this->status == 'published' && $this->getOldAttribute('status') != 'published') {
            $this->publishedAt = time();
        }
        return parent::beforeValidate();
    }

    /**
     * @return \yii\db\ActiveQuery|PostCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PostCategory::class, ['id' => 'categoryId']);
    }
}
