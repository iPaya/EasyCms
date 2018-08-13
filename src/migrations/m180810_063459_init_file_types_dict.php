<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;
use App\Models\Dict;
use yii\db\conditions\InCondition;


/**
 * Class m180810_063459_init_file_types
 */
class m180810_063459_init_file_types_dict extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 创建文件类型字典
        if (!$this->createFileType()) {
            return false;
        }
        if (!$this->createImageMimeTypes()) {
            return false;
        }

    }

    public function createFileType()
    {
        $code = 'fileType';
        $name = '文件类型';
        $dictItems = [
            ['name' => '图片', 'value' => 'image', 'sortNo' => 1],
            ['name' => '其他', 'value' => 'file', 'sortNo' => 4],
        ];
        return Dict::create($code, $name, $dictItems);
    }

    /**
     * @return bool
     */
    public function createImageMimeTypes()
    {
        $code = 'imageMimeTypes';
        $name = '图片 MimeType';
        $dictItems = [
            ['name' => 'JPG/JPEG/JPE', 'value' => 'image/jpeg', 'sortNo' => 1],
            ['name' => 'PNG', 'value' => 'image/png', 'sortNo' => 2],
            ['name' => 'GIF', 'value' => 'image/gif', 'sortNo' => 3],
            ['name' => 'WEBP', 'value' => 'image/webp', 'sortNo' => 4],
        ];
        return Dict::create($code, $name, $dictItems);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Dict::deleteAll(new InCondition('code', 'IN', [
            'fileType',
            'imageMimeTypes'
        ]));
    }

}
