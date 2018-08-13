<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Assets\Lightbox\LightboxAsset;
use App\Models\File;
use App\Models\FileDir;
use iPaya\ScriptBlock\ScriptBlock;
use yii\helpers\Html;

/* @var $this yii\web\View */
/** @var $models File[]|FileDir[] */
/** @var $dir FileDir */

$this->title = '文件管理';

LightboxAsset::register($this);
?>
<?php ScriptBlock::begin() ?>
<script>
    $(document).on('change', '#file', function () {
        var $this = $(this);
        var formData = new FormData();
        formData.append('file', this.files[0]);
        formData.append(yii.getCsrfParam(), yii.getCsrfToken());

        $.ajax({
            url: "<?=\yii\helpers\Url::to(['file/upload', 'dir' => $dir->id])?>",
            type: "post",
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (rs) {
                if (rs.errorCode == 0) {
                    location.reload();
                } else {
                    alert(rs.errorMessage);
                }
            },
            complete: function () {
                $this.val(null);
            }
        });
    });
</script>
<?php ScriptBlock::end() ?>
<div class="file-index">
    <p>
        <?= Html::beginTag('label', ['class' => 'btn btn-primary m-0']) ?>
        上传文件
        <?= Html::fileInput('file', null, ['class' => 'd-none', 'id' => 'file']) ?>
        <?= Html::endTag('label') ?>

        <?= Html::a('新建文件夹', ['dir/create', 'id' => $dir->id, 'returnUrl' => Yii::$app->request->url], ['class' => 'btn btn-outline-success']) ?>
    </p>

    <?php if ($dir->parentId != 0): ?>
        <p>
            <?= Html::a('返回上一级', ['index', 'dir' => $dir->parentId]) ?>
            | <samp><?= $dir->dir ?></samp>
        </p>
    <?php endif; ?>

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
</div>
