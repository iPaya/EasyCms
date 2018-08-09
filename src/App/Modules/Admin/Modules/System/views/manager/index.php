<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel App\Modules\Admin\Modules\System\Models\ManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员';
?>
<div class="manager-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'header'=>'角色',
                'format'=>'raw',
                'value'=>function($model, $key, $index, $column){
                    $roles = auth_manager()->getRolesByUser($model->id);
                    ob_start();

                    foreach($roles as $role){
                        echo Html::tag('span', $role->description , ['class' => 'badge badge-primary'])."\n";
                    }

                    return ob_get_clean();
                }
            ],
            'email:email',
            //'createdAt',
            'updatedAt:datetime',

            ['class' => \EasyCms\Widgets\ActionColumn::class],
        ],
    ]); ?>
</div>
