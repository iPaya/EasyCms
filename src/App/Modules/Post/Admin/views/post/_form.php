<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model App\Models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categoryId')->dropDownList(\yii\helpers\ArrayHelper::map(\App\Models\PostCategory::find()->andWhere('parentId != 0')->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(\App\Widgets\UEditor\UEditor::class, [
        'clientOptions' => [
            'serverUrl' => \yii\helpers\Url::to(module_url(module('admin'), ['ueditor/index']))
        ]
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(dict_manager()->get('postStatus')) ?>

    <?= $form->field($model, 'type')->dropDownList(dict_manager()->get('postType')) ?>

    <?= $form->field($model, 'original')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'originalUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'editor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
