<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Assets;


use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@App/Assets/assets';
    public $css = [
        'css/site.css'
    ];
    public $depends = [
        'iPaya\Bootstrap\BootstrapAsset'
    ];
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
}
