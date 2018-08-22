<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

use yii\helpers\ArrayHelper;

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
     * @param string $dir
     * @return FileDir
     */
    public static function getOrCreate(string $dir): FileDir
    {
        $dirs = preg_split('/(\/)/', $dir, -1, PREG_SPLIT_NO_EMPTY);
        $path = '';
        $currentDir = null;
        foreach ($dirs as $name) {
            $path .= '/' . $name;
            $dir = FileDir::find()->andWhere(['dir' => $path])->one();
            if ($dir == null) {
                $dir = new FileDir([
                    'name' => $name,
                ]);
                if ($currentDir == null) {
                    $dir->parentId = 1;
                } else {
                    $dir->parentId = $currentDir->id;
                }
                $dir->save();
            }
            $currentDir = $dir;
        }
        return $currentDir;
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

    /**
     * @param bool $recursive
     * @return FileDir[]|array
     */
    public function getDirs($recursive = true)
    {
        if (!$recursive) {
            return static::find()->andWhere(['parentId' => $this->id])->all();
        } else {
            $subDirs = static::find()->andWhere(['parentId' => $this->id])->all();
            $dirs = [];
            foreach ($subDirs as $dir) {
                $dirs = ArrayHelper::merge($subDirs, $dir->getDirs(true));
            }
            return $dirs;
        }
    }
}
