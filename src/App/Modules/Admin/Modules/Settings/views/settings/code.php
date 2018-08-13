<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Settings\AbstractSettings;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var $this View */
/** @var $model AbstractSettings */

$this->title = $model::title();
?>
<h1><?= $model::title() ?></h1>
<div class="form-settings">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'head')->textarea([
        'rows' => 8,
        'maxLength' => true,
    ]) ?>

    <?= $form->field($model, 'foot')->textarea([
        'rows' => 8,
        'maxLength' => true,
    ]) ?>

    <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end() ?>
</div>
