<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model App\Models\Manager */
/** @var $roles array */
/** @var $managerRoles array */

$this->title = $model->name;
?>
<div class="manager-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除此项?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'options'=>[
            'class'=>'listview table table-sm table-bordered table-striped'
        ],
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'updatedAt:datetime',
        ],
    ]) ?>

    <h3>角色</h3>
    <?= \yii\helpers\Html::beginForm() ?>
    <div class="list-group" style="height: 45vh">
        <?php foreach ($roles as $name => $description): ?>
            <label class="list-group-item">
                <?= \yii\helpers\Html::checkbox('roles[]', key_exists($name, $managerRoles), [
                    'value' => $name,
                ]) ?>
                <?= $description ?>
            </label>
        <?php endforeach; ?>
    </div>

    <?= \yii\helpers\Html::submitButton('保存', ['class' => 'btn btn-primary', 'id' => 'save']) ?>

    <?= \yii\helpers\Html::endForm() ?>

</div>
