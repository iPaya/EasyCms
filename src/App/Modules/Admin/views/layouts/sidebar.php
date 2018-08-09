<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use EasyCms\Module;
use yii\helpers\ArrayHelper;

$currentModule = current_module();
$sidebarMenu = [];
$modules = Yii::$app->modules;
foreach ($modules as $module) {
    if ($module instanceof Module) {
        $sidebarMenu = ArrayHelper::merge($sidebarMenu, $module->getNav());
    }
}
?>
<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-2 text-muted">
    <span>导航栏</span>
</h6>
<?= \EasyCms\Widgets\SidebarNav::widget([
    'items' => $sidebarMenu,
]) ?>
