<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model App\Models\User */

$this->title = $model->nickname;
$currentUrl = Yii::$app->request->url;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-fw fa-pencil-alt"></i> 修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('重置密码', ['reset-password', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        &nbsp;-&nbsp;
        <?php if ($model->getIsActive()): ?>
            <?= Html::a('<i class="fa fa-fw fa-lock"></i> 锁定', ['lock', 'id' => $model->id, 'returnUrl' => $currentUrl], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '确认锁定?锁定后用户将不能登录',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if ($model->getIsLocked()): ?>
            <?= Html::a('<i class="fa fa-fw fa-unlock"></i> 激活', ['active', 'id' => $model->id, 'returnUrl' => $currentUrl], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => '确认激活?激活后用户将可以登录',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nickname',
            'email:email',
            'status:userStatus',
            'registeredAt:datetime',
            'loginTimes',
            'lastLoginIp',
            'lastLoginAt:datetime',
            'createdAt:datetime',
            'updatedAt:datetime',
        ],
    ]) ?>

</div>
