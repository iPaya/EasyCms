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
 *
 * @property PostCategory $parent
 * @property PostCategory[] $children
 * @property int $childrenCount
 */
class PostCategory extends BasePostCategory
{
    /**
     * {@inheritdoc}
     * @return PostCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostCategoryQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery|PostCategoryQuery
     */
    public function getParent()
    {
        return $this->hasOne(PostCategory::class, ['id' => 'parentId']);
    }

    /**
     * @return int|string
     */
    public function getChildrenCount()
    {
        return $this->getChildren()->count();
    }

    /**
     * @return \yii\db\ActiveQuery|PostCategoryQuery
     */
    public function getChildren()
    {
        return $this->hasMany(PostCategory::class, ['parentId' => 'id']);
    }

    /**
     * @return array
     */
    public function treeViewItems()
    {
        $items = [];

        foreach ($this->children as $category) {
            $items[] = [
                'label' => $category->name,
                'items' => $category->treeViewItems(),
                'links' => [
                    ['label' => '添加子分类', 'url' => ['create', 'parentId' => $category->id]],
                    ['label' => '编辑', 'url' => ['update', 'id' => $category->id]],
                ],
            ];
        }

        return $items;
    }
}
