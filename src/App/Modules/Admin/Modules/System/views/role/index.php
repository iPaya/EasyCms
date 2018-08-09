<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\web\View;

/** @var $this View */
/** @var $dataProvider ArrayDataProvider */

$this->title = '角色';
?>
<div class="permission-index">
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'header' => '角色',
                'attribute' => 'description',
                'format' => 'raw',
                'value' => function (\yii\rbac\Role $role) {
                    return $role->description . ' <small class="text-muted">(' . $role->name . ')</small>';
                }
            ],
            [
                'header' => '权限',
                'format' => 'raw',
                'value' => function (\yii\rbac\Role $role) {
                    $permissions = auth_manager()->getPermissionsByRole($role->name);

                    ob_start();
                    foreach ($permissions as $permission) {
                        echo Html::tag('span', $permission->description , ['class' => 'badge badge-secondary'])."\n";
                    }

                    return ob_get_clean();
                }
            ],
            [
                'class' => \EasyCms\Widgets\ActionColumn::class,
                'template' => '{permissions} {update} {delete}',
                'urlCreator' => function (string $action, \yii\rbac\Role $model, $key, $index, $column) {
                    return [$action, 'name' => $model->name];
                },
                'buttons' => [
                    'permissions' => function ($url, $model, $key) {
                        return Html::a('权限', $url);
                    }
                ]
            ]
        ]
    ]) ?>
</div>

