<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use EasyCms\Module;
use yii\widgets\Menu;

$module = Yii::$app->controller->module;
if ($module instanceof Module) {
    $menuItems = $module->getMenu();
} else {
    $menuItems = [];
}

?>
<?= Menu::widget([
    'options' => [
        'class' => 'nav flex-column'
    ],
    'itemOptions' => [
        'class' => 'nav-item',
    ],
    'items' => $menuItems,
    'linkTemplate' => '<a class="nav-link" href="{url}">{label}</a>',
]) ?>
