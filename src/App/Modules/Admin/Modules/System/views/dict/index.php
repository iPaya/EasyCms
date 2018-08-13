<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel App\Modules\Admin\Modules\System\Models\DictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '字典管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dict-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'code',
            'name',
            'updatedAt:datetime',

            ['class' => \App\Widgets\ActionColumn::class],
        ],
    ]); ?>
</div>
