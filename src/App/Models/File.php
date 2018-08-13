<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

use App\Helpers\FileHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property int $id
 * @property int $rawId 原始文件
 * @property string $type 文件类型
 * @property string $uploadedDatetime 上传时间
 * @property int $createdAt
 * @property int $updatedAt
 * @property FileRaw $raw
 */
class File extends BaseFile
{
    /**
     * @param FileDir $dir
     * @param $filename
     * @param string $contents
     * @param null $mimeType
     * @return File|bool
     */
    public static function uploadContents(FileDir $dir, $filename, string $contents, $mimeType = null)
    {
        $config = [];
        if ($mimeType) {
            $config['mimeType'] = $mimeType;
        }

        $file = File::find()
            ->alias('t')
            ->leftJoin(['t2' => '{{%file_raw}}'], 't.rawId=t2.id')
            ->andWhere(['t2.filename' => $filename, 'dirId' => $dir->id])
            ->one();

        if ($file) {
            return false;
        }

        $filename = date('Y/m/d/') . $filename;

        $raw = FileRaw::put($filename, $contents, $config);
        if ($raw == false) {
            return false;
        }
        $model = new File();
        $model->rawId = $raw->id;
        $model->dirId = $dir->id;
        $model->type = FileHelper::isImage($raw->mimeType) ? 'image' : 'file';
        $model->uploadedDatetime = date('Y-m-d H:i:s');
        if (!$model->save()) {
            return false;
        }
        return $model;
    }

    /**
     * {@inheritdoc}
     * @return FileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FileQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery|FileRawQuery
     */
    public function getRaw()
    {
        return $this->hasOne(FileRaw::class, ['id' => 'rawId']);
    }

    public function getUrl()
    {
        return Url::to(['/file/file/view', 'id' => $this->id, 'filename' => $this->raw->filename]);
    }
}
