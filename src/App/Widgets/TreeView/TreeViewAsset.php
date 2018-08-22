<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Widgets\TreeView;


use yii\web\AssetBundle;

class TreeViewAsset extends AssetBundle
{
    public $sourcePath = '@App/Widgets/TreeView/assets';

    public $css = [
        'jquery.treeview.css'
    ];
    public $js = [
        'jquery.treeview.js',
    ];
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
