<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Models\DictItem;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model App\Models\Dict */
/** @var DictItem $itemModel */
/** @var DictItem[] $items */


$this->title = $model->name;


?>
<div class="dict-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除前请确认此字典已停止使用，否则会引起系统错误?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => [
            'class' => 'detail-view table table-bordered table-striped table-sm'
        ],
        'attributes' => [
            'id',
            'code',
            'name',
            'createdAt:datetime',
            'updatedAt:datetime',
        ],
    ]) ?>

    <h2>字典项</h2>
    <div class="form-dict-item">
        <?= Html::beginForm() ?>

        <?= Html::errorSummary($itemModel, ['class' => 'alert alert-danger']) ?>
        <div class="form-row">
            <div class="form-group col-3">
                <?= Html::activeTextInput($itemModel, 'name', [
                    'class' => 'form-control',
                    'placeholder' => '名称'
                ]) ?>
            </div>
            <div class="form-group col-3">
                <?= Html::activeTextInput($itemModel, 'value', [
                    'class' => 'form-control',
                    'placeholder' => '值'
                ]) ?>
            </div>
            <div class="form-group col-2">
                <?= Html::activeTextInput($itemModel, 'sortNo', [
                    'class' => 'form-control',
                    'placeholder' => '排序: 数值越小越靠前'
                ]) ?>
            </div>
            <div class="form-group col">
                <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?= Html::endForm() ?>
    </div>

    <table class="table table-bordered table-sm text-center">
        <colgroup>
            <col width="200">
            <col>
            <col width="120">
            <col width="120">
        </colgroup>
        <thead class="thead-light">
        <tr>
            <th scope="col">名称</th>
            <th scope="col">值</th>
            <th scope="col">序号</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <th><?= $item->name ?></th>
                <td><?= $item->value ?></td>
                <td><?= $item->sortNo ?></td>
                <td>

                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>预览</h2>

    <?=Html::dropDownList('preview',null,dict_manager()->get($model->code),['class'=>'form-control'])?>
</div>
