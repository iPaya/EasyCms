<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Modules\Admin\Modules\Account\Models\ProfileForm;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var $this View */
/** @var $model ProfileForm */

$this->title = '个人资料';
?>
<div class="profile-index">
    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'name') ?>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
