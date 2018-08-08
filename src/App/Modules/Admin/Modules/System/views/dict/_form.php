<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model App\Models\Dict */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dict-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord): ?>
        <?= $form->field($model, 'code')->textInput(['maxlength' => true])->hint('创建后不可修改') ?>
    <?php else: ?>
        <div class="form-group">
            <?= Html::activeLabel($model, 'code', ['class' => 'control-label']) ?>
            <input type="text" readonly class="form-control-plaintext" value="<?= $model->code ?>">
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
