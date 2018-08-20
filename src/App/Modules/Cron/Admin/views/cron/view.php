<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model App\Models\Cron */

$this->title = $model->name;
?>
<div class="cron-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除?',
                'method' => 'post',
            ],
        ]) ?>
        &nbsp;-&nbsp;
        <?= Html::a('执行', ['push', 'id' => $model->id, 'returnUrl' => Yii::$app->request->url], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => '确认执行?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'jobClass',
            'jobParams:ntext',
            'cron',
            'status:cronStatus',
            'createdAt:datetime',
            'updatedAt:datetime',
        ],
    ]) ?>

</div>
