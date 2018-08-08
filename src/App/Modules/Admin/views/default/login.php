<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Modules\Admin\Models\LoginForm;
use yii\helpers\Html;
use yii\web\View;

/** @var $this View */
/** @var $model LoginForm */

?>
<?= Html::beginForm('', 'post', [
    'class' => 'form-login'
]) ?>
<h1 class="h3 text-center mb-3 font-weight-normal"><?= admin_name() ?></h1>

<?=Html::errorSummary($model,[
        'class'=>'alert alert-danger'
])?>

<?= Html::activeTextInput($model, 'email', ['placeholder' => '邮箱', 'class' => 'form-control', 'type' => 'email']) ?>

<?= Html::activePasswordInput($model, 'password', ['placeholder' => '密码', 'class' => 'form-control', 'autocomplete' => 'off']) ?>

<?= \yii\captcha\Captcha::widget([
    'model' => $model,
    'attribute' => 'verifyCode',
    'captchaAction' => 'default/captcha',
    'template' => '<div class="input-group mb-2 mr-sm-2"><div class="input-group-prepend"><div class="input-group-text p-0">{image}</div></div>{input}</div>',
    'options' => [
        'class' => 'form-control',
        'placeholder' => '请输入左侧验证码'
    ],
]) ?>

<button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
<p class="mt-5 mb-3 text-muted">&copy; <?= date('Y') ?></p>
<?= Html::endForm() ?>
