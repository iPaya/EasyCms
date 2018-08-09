<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Modules\Admin\Modules\System\Models\RoleForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var $this View */
/** @var $model RoleForm */

?>
<div class="permission-form">
    <?php $form = ActiveForm::begin() ?>

    <?= Html::errorSummary($model, ['class' => 'alert alert-danger']) ?>

    <?= $form->field($model, 'name')->textInput(['readonly' => $model->scenario != RoleForm::SCENARIO_CREATE]) ?>
    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
