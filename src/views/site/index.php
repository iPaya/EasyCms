<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Settings\SiteSettings;
use yii\web\View;

/** @var $this View */
$siteSettings = SiteSettings::getInstance();
$this->title = $siteSettings->name . ' - ' . $siteSettings->description;

?>
<style>
    header {
        padding: 154px 0 100px;
    }

    @media (min-width: 992px) {
        header {
            padding: 156px 0 100px;
        }
    }

    section {
        padding: 150px 0;
    }
</style>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><?= $siteSettings->name ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">关于</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#features">功能</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">联系</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="bg-dark text-white">
    <div class="container text-center">
        <h1>欢迎使用 EasyCms</h1>
        <p class="lead">一个基于 Yii 框架的 CMS 建站系统</p>
    </div>
</header>

<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>关于 EasyCms</h2>
                <p class="lead">EasyCms 是一款基于 Yii, MySQL, Redis 开发的 CMS 建站系统。</p>
                <ul>
                    <li>基于 Yii 开发框架</li>
                    <li>MySQL 开源数据库</li>
                    <li>免费源码开放</li>
                    <li>Redis 缓存、队列</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="features" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>功能</h2>
                <ul>
                    <li>配置管理</li>
                    <li>计划任务</li>
                    <li>RBAC</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>联系我们</h2>
                <ul>
                    <li><strong>Github:</strong> https://github.com/</li>
                </ul>
            </div>
        </div>
    </div>
</section>
