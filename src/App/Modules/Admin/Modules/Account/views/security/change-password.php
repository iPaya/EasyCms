<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Modules\Admin\Modules\Account\Models\ChangePasswordForm;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var $this View */
/** @var $model ChangePasswordForm */

$this->title = '修改密码';
?>
<div class="profile-index">
    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'oldPassword')->passwordInput() ?>
    <?= $form->field($model, 'newPassword')->passwordInput() ?>
    <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
