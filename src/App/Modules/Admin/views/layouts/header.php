<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Models\Manager;
use yii\web\View;
use yii\widgets\Menu;

/** @var $this View */
/** @var Manager $identity */
$identity = Yii::$app->user->getIdentity();
$adminModule = admin_module();
$navItems = [
    ['label' => '消息 <span class="badge badge-pill badge-danger">1</span>', 'url' => '',],
    ['label' => $identity->name, 'url' => module_url($adminModule, ['account/profile/index'])],
    ['label' => '退出', 'url' => module_url($adminModule, ['default/logout']), 'linkOptions' => ['data-method' => 'post']],
];

?>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark p-0 bg-dark">
    <a class="navbar-brand text-center"
       href="<?= \yii\helpers\Url::to(['/admin']) ?>"><?= admin_name() ?></a>
    <?= Menu::widget([
        'encodeLabels' => false,
        'options' => [
            'class' => 'navbar-nav ml-auto mr-2',
        ],
        'itemOptions' => [
            'class' => 'nav-item pl-2 pr-2'
        ],
        'linkTemplate' => '<a class="nav-link" href="{url}">{label}</a>',
        'items' => $navItems,
    ]) ?>
</nav>
