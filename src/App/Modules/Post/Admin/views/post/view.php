<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model App\Models\Post */

$this->title = $model->title;
?>
<div class="post-view">

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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category.name:raw:分类',
            'title',
            'content:ntext',
            'visitCount',
            'editor',
            'author',
            'status:postStatus',
            'publishedAt:datetime',
            'type:postType',
            'original',
            'originalUrl',
            'createdAt:datetime',
            'updatedAt:datetime',
        ],
    ]) ?>

</div>
