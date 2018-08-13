<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Models\FileDir;
use yii\web\View;

/** @var $this View */
/** @var $model FileDir */
?>
<div class="form-dir">
    <?= \yii\helpers\Html::beginForm() ?>

    <?=\yii\helpers\Html::errorSummary($model,['class'=>'alert alert-danger'])?>

    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><?= $model->parent->dir ?>/</div>
            </div>
            <?= \yii\helpers\Html::activeTextInput($model, 'name', ['class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>

    <?= \yii\helpers\Html::endForm() ?>
</div>
