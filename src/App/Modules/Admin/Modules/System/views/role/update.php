<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Modules\Admin\Modules\System\Models\RoleForm;
use yii\web\View;

/** @var $this View */
/** @var $model RoleForm */

$this->title = '修改角色: ' . $model->description;
?>
<div class="role-create">
    <h1>修改角色</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
