<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Settings\AbstractSettings;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/** @var $this View */
/** @var $model AbstractSettings */

$this->title = $model::title();
?>
<h1><?= $model::title() ?></h1>
<div class="form-settings">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'targetRoute')->textInput(['maxLength' => true]) ?>

    <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end() ?>
</div>
