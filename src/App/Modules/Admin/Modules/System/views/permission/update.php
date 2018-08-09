<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Modules\Admin\Modules\System\Models\PermissionForm;
use yii\web\View;

/** @var $this View */
/** @var $model PermissionForm */

$this->title = '修改权限: '.$model->description;
?>
<div class="permission-create">
    <h1>修改权限</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
