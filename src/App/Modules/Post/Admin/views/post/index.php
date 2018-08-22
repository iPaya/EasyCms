<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel App\Modules\Post\Admin\Models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章';
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'category.name:raw:分类',
            'title',
            'visitCount',
            //'editor',
            //'author',
            'status:postStatus',
            'publishedAt:datetime',
            'type:postType',
            //'original',
            //'originalUrl',
            //'createdAt',
            //'updatedAt',

            [
                'class' => \App\Widgets\ActionColumn::class,
            ],
        ],
    ]); ?>
</div>
