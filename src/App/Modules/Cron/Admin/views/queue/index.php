<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */


use yii\web\View;

/** @var $this View */
/** @var $count int */
/** @var $messages string[] */
/** @var $page int */
/** @var $pageSize int */
/** @var $pages int */

$this->title = '消息队列';

?>
<h1>消息队列</h1>
<table class="table">
    <caption>共 <?= $pages ?> 页, 每页 <?= $pageSize ?> 条, 第 <?= $page ?> 页</caption>
    <thead class="thead-light">
    <tr>
        <th scope="col" style="width: 60px;">索引</th>
        <th scope="col">消息</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($messages as $index => $message): ?>
        <tr>
            <th scope="row"><?= $index ?></th>
            <td><?= $message ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
