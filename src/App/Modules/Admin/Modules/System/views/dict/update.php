<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model App\Models\Dict */

$this->title = '修改: ' . $model->name;
?>
<div class="dict-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
