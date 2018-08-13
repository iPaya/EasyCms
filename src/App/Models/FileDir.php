<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

/**
 *
 * @property int $id
 * @property string $name 名称
 * @property string $dir 目录
 * @property int $parentId 上级目录
 * @property int $createdAt
 * @property int $updatedAt
 * @property FileDir $parent
 */
class FileDir extends BaseFileDir
{
    /**
     * {@inheritdoc}
     * @return FileDirQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FileDirQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery|FileDirQuery
     */
    public function getParent()
    {
        return $this->hasOne(FileDir::class, ['id' => 'parentId']);
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        if ($this->parent) {
            $this->dir = $this->parent->dir . '/' . $this->name;
        }

        return parent::beforeValidate();
    }
}
