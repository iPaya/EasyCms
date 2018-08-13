<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Assets;


use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $sourcePath = '@App/Modules/Admin/Assets/assets';

    public $css = [
        'css/admin.css'
    ];
    public $depends = [
        'iPaya\Bootstrap\BootstrapAsset',
        'yii\web\YiiAsset',
        'App\Assets\FontAwesome\FontAwesomeAsset',
    ];
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
}
