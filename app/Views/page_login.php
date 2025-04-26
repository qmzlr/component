<?php
$this->layout('layout', ['title' => 'Login']);

$this->push('styles') ?>
<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="../../resource/css/vendors.bundle.css">
<link id="appbundle" rel="stylesheet" media="screen, print" href="../../resource/css/app.bundle.css">
<link id="mytheme" rel="stylesheet" media="screen, print" href="#">
<link id="myskin" rel="stylesheet" media="screen, print" href="../../resource/css/skins/skin-master.css">
<!-- Place favicon.ico in the root directory -->
<link rel="apple-touch-icon" sizes="180x180" href="../../resource/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../resource/img/favicon/favicon-32x32.png">
<link rel="mask-icon" href="../../resource/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
<link rel="stylesheet" media="screen, print" href="../../resource/css/page-login-alt.css">
<?php
$this->end();

$this->push('scripts') ?>
<script src="../../resource/js/vendors.bundle.js"></script>
<?php
$this->end();
?>
<div class="blankpage-form-field">
    <div class="blankpage-form-field">
        <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                <img src="../../../resource/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                <span class="page-logo-text mr-1">Учебный проект</span>
                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
            </a>
        </div>
        <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
            <?= $flash; ?>
            <form action="/authorization" method="post">
                <div class="form-group">
                    <label class="form-label" for="username">Email</label>
                    <input type="email" id="username" class="form-control" placeholder="Эл. адрес" value=""
                           name="email">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Пароль</label>
                    <input type="password" id="password" class="form-control" placeholder="" name="password">
                </div>
                <button type="submit" class="btn btn-default float-right">Войти</button>
            </form>
        </div>
        <div class="blankpage-footer text-center">
            Нет аккаунта? <a href="/"><strong>Зарегистрироваться</strong></a>
        </div>
    </div>
    <video poster="../../resource/img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
        <source src="../../resource/media/video/cc.webm" type="video/webm">
        <source src="../../resource/media/video/cc.mp4" type="video/mp4">
    </video>
    <script src="../../resource/js/vendors.bundle.js"></script>