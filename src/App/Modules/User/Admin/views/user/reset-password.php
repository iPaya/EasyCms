<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Models\User;
use App\Modules\User\Admin\Models\ResetPasswordForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var $this yii\web\View */
/** @var $model ResetPasswordForm */
/** @var $user User */

$this->title = '重置密码 #' . $user->id;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('重置密码', ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
