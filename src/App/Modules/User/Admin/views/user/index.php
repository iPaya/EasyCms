<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel App\Modules\User\Admin\Models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '所有用户';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'nickname',
            'status:userStatus',
            'registeredAt:datetime',
            'loginTimes',
            'lastLoginIp',
            'lastLoginAt',

            [
                'class' => \App\Widgets\ActionColumn::class,
                'options' => [
                    'style' => 'width: 120px;'
                ]
            ],
        ],
    ]); ?>
</div>
