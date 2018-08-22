<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Models\PostCategory;
use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $models PostCategory[] */
/** @var $items array */

$this->title = '文章分类';
?>
<div class="post-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加顶级分类', ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
    </p>
    <?= \App\Widgets\TreeView\TreeView::widget([
        'items' => $items,
        'encodeLabels' => false,
    ]) ?>

</div>
