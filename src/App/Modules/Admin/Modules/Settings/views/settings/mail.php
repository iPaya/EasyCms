<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Settings\AbstractSettings;
use iPaya\ScriptBlock\ScriptBlock;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/** @var $this View */
/** @var $model AbstractSettings */

$this->title = $model::title();
?>
<?php ScriptBlock::begin() ?>
<script>
    var $testingTips = $('#testing-tips');
    var $form = $('#form-settings');

    $(document).on('click', '#btn-test', function () {
        console.log($form.serialize());
        $.ajax({
            url: "<?=\yii\helpers\Url::to(['test-mail'])?>",
            data: $form.serialize(),
            type: 'POST',
            dataType: 'json',
            success: function (rs) {
                if (rs.errorCode == 0) {
                    $testingTips.html(rs.html);
                    $testingTips.css('display', 'block');
                } else {
                    alert(rs.errorMessage);
                }
            }
        });
    });
</script>
<?php ScriptBlock::end() ?>
<h1><?= $model::title() ?></h1>
<div class="form-settings">
    <?php $form = ActiveForm::begin([
        'id' => 'form-settings'
    ]); ?>

    <?= $form->field($model, 'sender')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxLength' => true,]) ?>
    <?= $form->field($model, 'smtp')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'port')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'encryption')->dropDownList([
        'tls' => '默认 TLS',
        'ssl' => 'SSL 加密'
    ]) ?>

    <div class="form-group">
        <?= Html::button('发送测试', ['class' => 'btn btn-warning', 'id' => 'btn-test']) ?>
        <p class="alert alert-warning mt-2" style="display: none;" id="testing-tips"></p>
    </div>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
