<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Models;

use yii\helpers\FileHelper;

/**
 * This is the model class for table "{{%file_raw}}".
 *
 * @property int $id
 * @property string $filename 文件名
 * @property string $hash Hash
 * @property string $mimeType Mime Type
 * @property string $path 路径
 * @property string $uploadDatetime 上传时间
 * @property int $createdAt
 * @property int $updatedAt
 */
class FileRaw extends BaseFileRaw
{
    /**
     * @param string $path
     * @param string $contents
     * @param array $config
     * @return FileRaw|false
     */
    public static function put(string $path, string $contents, array $config = [])
    {
        // 判断原始文件是否存在
        $path = self::normalizePath($path);
        $hash = self::hashContents($contents);

        $raw = FileRaw::findOneByHash($hash);
        if ($raw == null) {
            if (!file_system()->put($path, $contents)) {
                return false;
            } else {
                $raw = new FileRaw([
                    'filename' => pathinfo($path, PATHINFO_BASENAME),
                    'hash' => $hash,
                    'mimeType' => self::resolveMimeType($path, $config),
                    'path' => $path,
                    'size' => strlen($contents),
                    'uploadDatetime' => date('Y-m-d H:i:s'),
                ]);
                if (!$raw->save()) {
                    return false;
                }
                return $raw;
            }
        } else {
            return $raw;
        }

    }

    /**
     * @param string $path
     * @return string
     */
    protected static function normalizePath(string $path): string
    {
        $path = FileHelper::normalizePath($path);
        $path = ltrim($path, "\/");
        return $path;
    }

    /**
     * @param string $contents
     * @return string
     */
    public static function hashContents(string $contents): string
    {
        return sha1($contents);
    }

    /**
     * @param string $hash
     * @return FileRaw|null
     */
    public static function findOneByHash(string $hash): ?FileRaw
    {
        return self::find()->andWhere(['hash' => $hash])->one();
    }

    /**
     * {@inheritdoc}
     * @return FileRawQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FileRawQuery(get_called_class());
    }

    /**
     * @param string $path
     * @param array $config
     * @return mixed|null|string
     */
    protected static function resolveMimeType(string $path, array $config)
    {
        if (isset($config['mimeType'])) {
            return $config['mimeType'];
        }
        return FileHelper::getMimeTypeByExtension($path);
    }

    /**
     * @return bool|false|string
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function read()
    {
        return file_system()->read($this->path);
    }
}
