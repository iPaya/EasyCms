<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Helpers;


class FileHelper extends \yii\helpers\FileHelper
{
    /**
     * @param string $mimeType
     * @return bool
     */
    public static function isImage(string $mimeType): bool
    {
        $mimeTypes = array_keys(dict_manager()->get('imageMimeTypes'));
        return in_array($mimeType, $mimeTypes);
    }
}
