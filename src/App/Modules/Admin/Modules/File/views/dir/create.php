<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Models\FileDir;
use yii\web\View;

/** @var $this View */
/** @var $model FileDir */
/** @var $dir FileDir */

$this->title = '新建文件夹';
?>
<div class="dir-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
