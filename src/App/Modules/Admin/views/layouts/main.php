<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Modules\Admin\Assets\AdminAsset;
use EasyCms\Module;
use yii\helpers\Html;
use yii\web\View;

/** @var $this View */
/** @var $content string */
/** @var $module Module string */

AdminAsset::register($this);

$module = Yii::$app->controller->module;
if ($module instanceof Module) {
    $subMenu = $module->getMenu();
} else {
    $subMenu = [];
}

$hasSubmodule = count($subMenu) > 0;
?>
<?php $this->beginPage() ?>

    <!doctype html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <!-- Required meta tags -->
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <header class="main-header">
        <?= $this->render('header') ?>
    </header>
    <div class="main-body">
        <div class="main-sidebar">
            <?= $this->render('sidebar') ?>
        </div>
        <?php if ($hasSubmodule): ?>
            <div class="main-sub-sidebar">
                <?= $this->render('sub-sidebar') ?>
            </div>
        <?php endif; ?>
        <main role="main" class="main-content <?= $hasSubmodule ? 'has-submodule' : '' ?>">

            <?= $content ?>

            <footer class="main-footer mt-4 pt-2 mb-4">
                <hr/>
                <?= $this->render('footer') ?>
            </footer>
        </main>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>

<?php $this->endPage() ?>