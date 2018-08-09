<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\rbac\Role;
use yii\web\View;

/** @var $this View */
/** @var $permissions array */
/** @var $rolePermissions array */
/** @var $model Role */


$this->title = '角色权限: ' . $model->description;
?>
<div class="role-permissions">
    <h1>角色权限</h1>

    <hr/>

    <?= \yii\helpers\Html::beginForm() ?>
    <div class="list-group" style="height: 60vh">
        <?php foreach ($permissions as $name => $description): ?>
            <label class="list-group-item">
                <?= \yii\helpers\Html::checkbox('permissions[]', key_exists($name, $rolePermissions), [
                    'value' => $name,
                ]) ?>
                <?= $description ?>
            </label>
        <?php endforeach; ?>
    </div>

    <?= \yii\helpers\Html::submitButton('保存', ['class' => 'btn btn-primary', 'id' => 'save']) ?>

    <?= \yii\helpers\Html::endForm() ?>
</div>
