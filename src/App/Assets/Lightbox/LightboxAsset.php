<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Assets\Lightbox;


use yii\web\AssetBundle;

class LightboxAsset extends AssetBundle
{
    public $sourcePath = '@App/Assets/Lightbox/assets';
    public $css = [
        'css/lightbox.min.css'
    ];
    public $js = [
        'js/lightbox.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
