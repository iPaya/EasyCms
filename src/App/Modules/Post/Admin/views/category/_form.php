<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model App\Models\PostCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label class="control-label">上级分类</label>
        <?php if ($model->parentId == 0): ?>
            <p class="form-control-plaintext text-success">顶级分类</p>
        <?php else: ?>
            <p class="form-control-plaintext text-success">
                <?= $model->parent->name ?> <?= Html::a('<small>查看</small>', ['view', 'id' => $model->parentId], ['target' => '_blank']) ?>
            </p>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
