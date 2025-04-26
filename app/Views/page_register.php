<?php
$this->layout('layout', ['title' => 'Register']);
$this->push('styles') ?>
<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="../../resource/css/vendors.bundle.css">
<link id="appbundle" rel="stylesheet" media="screen, print" href="../../resource/css/app.bundle.css">
<link id="mytheme" rel="stylesheet" media="screen, print" href="#">
<link id="myskin" rel="stylesheet" media="screen, print" href="../../resource/css/skins/skin-master.css">
<!-- Place favicon.ico in the root directory -->
<link rel="apple-touch-icon" sizes="180x180" href="../../resource/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../resource/img/favicon/favicon-32x32.png">
<link rel="mask-icon" href="../../resource/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
<link rel="stylesheet" media="screen, print" href="../../resource/css/fa-brands.css">
<?php
$this->end();

$this->push('scripts') ?>
<script src="../../resource/js/vendors.bundle.js"></script>
<script>
    $("#js-login-btn").click(function (event) {

        // Fetch form to apply custom Bootstrap validation
        var form = $("#js-login")

        if (form[0].checkValidity() === false) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.addClass('was-validated');
        // Perform ajax submit here...
    });

</script>
<?php $this->end(); ?>
<div class="page-wrapper auth">
    <div class="page-inner bg-brand-gradient">
        <div class="page-content-wrapper bg-transparent m-0">
            <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                <div class="d-flex align-items-center container p-0">
                    <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                            <img src="../../resource/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">Учебный проект</span>
                        </a>
                    </div>
                    <span class="text-white opacity-50 ml-auto mr-2 hidden-sm-down">
Уже зарегистрированы?
                        </span>
                    <a href="/login" class="btn-link text-white ml-auto ml-sm-0">
                        Войти
                    </a>
                </div>
            </div>
            <div class="flex-1" style="background: url(../../resource/img/svg/pattern-1.svg) no-repeat center
                bottom fixed; background-size:cover;">
                <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                    <div class="row">
                        <div class="col-xl-12">
                            <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                Регистрация

                            </h2>
                        </div>
                        <div class="col-xl-6 ml-auto mr-auto">
                            <div class="card p-4 rounded-plus bg-faded">
                                <?= $flash ?>
                                <form id="js-login" novalidate="" action="/registration" method="post">
                                    <div class="form-group">
                                        <label class="form-label" for="emailverify">Email</label>
                                        <input type="email" id="emailverify" class="form-control"
                                               placeholder="Эл. адрес" name="email" required>
                                        <div class="invalid-feedback">Заполните поле.</div>
                                        <div class="help-block">Эл. адрес будет вашим логином при авторизации</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="userpassword">Пароль <br></label>
                                        <input type="password" id="userpassword" class="form-control" name="password"
                                               placeholder=""
                                               required>
                                        <div class="invalid-feedback">Заполните поле.</div>
                                    </div>

                                    <div class="row no-gutters">
                                        <div class="col-md-4 ml-auto text-right">
                                            <button id="js-login-btn" type="submit"
                                                    class="btn btn-block btn-danger btn-lg mt-3">Регистрация
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
