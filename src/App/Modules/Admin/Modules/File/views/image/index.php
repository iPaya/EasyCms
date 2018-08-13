<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use App\Assets\Lightbox\LightboxAsset;
use App\Models\File;
use App\Models\FileDir;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/** @var $models File[]|FileDir[] */
/** @var $dir FileDir */
/** @var $dataProvider ActiveDataProvider */

$this->title = '图片';
$models = $dataProvider->getModels();

LightboxAsset::register($this);
?>
<div class="image-index">
    <table class="table table-hover table-sm file-manager border-bottom">
        <thead class="thead-light">
        <tr>
            <th scope="col" colspan="2">文件名</th>
            <th scope="col" style="width: 100px;">大小</th>
            <th scope="col" style="width: 160px;">修改日期</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($models) == 0): ?>
            <tr>
                <td colspan="4">
                    <p class="text-muted text-center p-lg-4">暂时没有文件，请上传。</p>
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($models as $model): ?>
                <tr>
                    <?php if ($model instanceof FileDir): ?>
                        <td class="icon">
                            <i class="fa fa-folder fa-fw text-warning"></i>
                        </td>
                        <td><?= Html::a($model->name, ['index', 'dir' => $model->id]) ?></td>
                        <td>-</td>
                        <td class="text-muted"><?= date('Y-m-d H:i', $model->updatedAt) ?></td>
                    <?php elseif ($model instanceof File): ?>
                        <td class="icon">
                            <?php if ($model->type == 'image'): ?>
                                <i class="fa fa-file-image fa-fw text-danger"></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($model->type == 'image') {
                                $linkOptions = [
                                    'data-lightbox' => 'file-preview',
                                    'data-title' => $model->raw->filename,
                                ];
                            } else {
                                $linkOptions = [];
                            }
                            ?>
                            <?= Html::beginTag('a', \yii\helpers\ArrayHelper::merge([
                                'href' => $model->getUrl(),
                                'target' => '_blank'
                            ], $linkOptions)) ?>
                            <?= $model->raw->filename ?>
                            <?= Html::endTag('a') ?>
                        </td>
                        <td class="text-muted"><?= format($model->raw->size, 'shortSize') ?></td>
                        <td class="text-muted"><?= date('Y-m-d H:i', $model->updatedAt) ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <?=\yii\widgets\LinkPager::widget([
        'pagination'=>$dataProvider->getPagination(),
    ])?>
</div>
