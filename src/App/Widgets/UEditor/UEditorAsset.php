<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Widgets\UEditor;


use yii\web\AssetBundle;

class UEditorAsset extends AssetBundle
{
    public $sourcePath = '@App/Widgets/UEditor/assets';
    public $css = [];
    public $js = [
        'ueditor.config.js',
        'ueditor.all.min.js'
    ];
    public $publishOptions = [
        'except' => [
            '/php/*'
        ]
    ];
}
