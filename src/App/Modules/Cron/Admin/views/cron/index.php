<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\grid\GridView;
use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $searchModel App\Modules\Cron\Admin\Models\CronSearch */
/** @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '所有定时任务';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cron-index ">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'cron:cron',
            'status:cronStatus',
            //'createdAt',
            'updatedAt:datetime',

            [
                'class' => \App\Widgets\ActionColumn::class,
                'template' => '{enable} {disable} | {view} {update} {delete}',
                'options' => [
                    'style' => 'width: 240px;'
                ],
                'buttons' => [
                    'enable' => function ($url, \App\Models\Cron $model, $key) {
                        if (!$model->getIsEnabled()) {
                            return Html::a('开启', $url, [
                                'class' => 'btn btn-success btn-sm',
                                'data-method' => 'post',
                                'data-confirm' => '确认开启？',
                            ]);
                        }
                    },
                    'disable' => function ($url, \App\Models\Cron $model, $key) {
                        if ($model->getIsEnabled()) {
                            return Html::a('关闭', $url, [
                                'class' => 'btn  btn-danger btn-sm',
                                'data-method' => 'post',
                                'data-confirm' => '确认关闭',
                            ]);
                        }
                    }
                ]
            ],
        ],
    ]); ?>
</div>
