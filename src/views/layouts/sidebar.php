<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\widgets\Menu;

$sidebarMenu = $this->params['sidebarMenu'] ?? [];
ksort($sidebarMenu);
?>
<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-2 text-muted">
    <span>管理模块</span>
</h6>
<?= Menu::widget([
    'options' => [
        'class' => 'nav flex-column'
    ],
    'itemOptions' => [
        'class' => 'nav-item',
    ],
    'items' => $sidebarMenu,
    'linkTemplate' => '<a class="nav-link" href="{url}">{label}</a>',
]) ?>
