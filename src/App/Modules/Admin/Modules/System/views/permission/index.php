<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\data\ArrayDataProvider;
use yii\web\View;

/** @var $this View */
/** @var $dataProvider ArrayDataProvider */

$this->title = '权限';
?>
<div class="permission-index">
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'header' => '权限',
                'attribute' => 'description',
                'format' => 'raw',
                'value' => function (\yii\rbac\Permission $permission) {
                    return $permission->description . ' <small class="text-muted">(' . $permission->name . ')</small>';
                }
            ],
            [
                'class' => \EasyCms\Widgets\ActionColumn::class,
                'template' => '{update} {delete}',
                'urlCreator' => function (string $action, \yii\rbac\Permission $model, $key, $index, $column) {
                    return [$action, 'name' => $model->name];
                }
            ]
        ]
    ]) ?>
</div>

