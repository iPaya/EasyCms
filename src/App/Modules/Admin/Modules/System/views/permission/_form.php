<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Modules\Admin\Modules\System\Models\PermissionForm;
use yii\rbac\Permission;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this View */
/** @var $model PermissionForm */

?>
<div class="permission-form">
    <?php $form = ActiveForm::begin()?>

    <?=Html::errorSummary($model,['class'=>'alert alert-danger'])?>

    <?=$form->field($model,'name')->textInput(['readonly'=>true])?>
    <?=$form->field($model,'description')->textInput()?>

    <div class="form-group">
        <?=Html::submitButton('提交',['class'=>'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end()?>
</div>
