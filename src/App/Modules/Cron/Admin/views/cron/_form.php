<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use iPaya\ScriptBlock\ScriptBlock;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model App\Models\Cron */
/* @var $form yii\widgets\ActiveForm */
?>
<?php ScriptBlock::begin() ?>
<script>
    var $cron = $('#<?=Html::getInputId($model, 'cron')?>');

    $(document).on('change', '#cronSamples', function () {
        var value = $(this).val();
        $cron.val(value);
    });
</script>
<?php ScriptBlock::end() ?>
<div class="cron-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jobClass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jobParams')->textarea(['rows' => 4]) ?>

    <div class="form-group">
        <label class="control-label" for="cronSamples">预设</label>
        <?= Html::dropDownList('cronSamples', $model->cron, dict_manager()->get('cronCronSamples'), [
            'prompt' => '-- 预设 --',
            'class' => 'form-control',
            'id' => 'cronSamples'
        ]) ?>
    </div>

    <?= $form->field($model, 'cron')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(dict_manager()->get('cronStatus')) ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
