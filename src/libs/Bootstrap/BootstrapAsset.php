<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace iPaya\Bootstrap;


use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';
    public $css = [
        'css/bootstrap.min.css'
    ];
    public $js = [
        'js/bootstrap.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}