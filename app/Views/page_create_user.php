<?php

$this->layout('layoutHead', ['title' => 'Create user']);
$this->push('styles') ?>
<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="../../resource/css/vendors.bundle.css">
<link id="appbundle" rel="stylesheet" media="screen, print" href="../../resource/css/app.bundle.css">
<link id="myskin" rel="stylesheet" media="screen, print" href="../../resource/css/skins/skin-master.css">
<link rel="stylesheet" media="screen, print" href="../../resource/css/fa-solid.css">
<link rel="stylesheet" media="screen, print" href="../../resource/css/fa-brands.css">
<link rel="stylesheet" media="screen, print" href="../../resource/css/fa-regular.css">
<?php
$this->end();

$this->push('scripts') ?>

<script src="../../resource/js/vendors.bundle.js"></script>
<script src="../../resource/js/app.bundle.js"></script>
<script>

    $(document).ready(function () {


    });

</script>
<?php $this->end(); ?>

<main id="js-page-content" role="main" class="page-content mt-3">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-plus-circle'></i> Добавить пользователя
        </h1>


    </div>
    <form action="/createUser" method="post">
        <div class="row">
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Общая информация</h2>
                        </div>
                        <div class="panel-content">
                            <!-- username -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Имя</label>
                                <input type="text" id="simpleinput" name="username" class="form-control">
                            </div>

                            <!-- title -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Место работы</label>
                                <input type="text" id="simpleinput" name="job" class="form-control">
                            </div>

                            <!-- tel -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Номер телефона</label>
                                <input type="tel" id="simpleinput" name="phone" class="form-control">
                            </div>

                            <!-- address -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Адрес</label>
                                <input type="text" id="simpleinput" name="address" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Безопасность и Медиа</h2>
                        </div>
                        <div class="panel-content">
                            <!-- email -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Email</label>
                                <input type="email" id="simpleinput" name="email" class="form-control" required>
                            </div>

                            <!-- password -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Пароль</label>
                                <input type="password" id="simpleinput" name="password" class="form-control" required>
                            </div>


                            <!-- status -->
                            <div class="form-group">
                                <label class="form-label" for="example-select">Выберите статус</label>
                                <select class="form-control" name="state" id="example-select">
                                    <option value="Онлайн">Онлайн</option>
                                    <option value="Отошел">Отошел</option>
                                    <option value="Не беспокоить">Не беспокоить</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="example-fileinput">Загрузить аватар</label>
                                <input type="file" id="example-fileinput" name="avatar" class="form-control-file">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Социальные сети</h2>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- vk -->
                                    <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="fab fa-vk"></i>
                                                    </span>
                                                </span>
                                        </div>
                                        <input type="text" class="form-control border-left-0 bg-transparent pl-0"
                                               name="vk">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- telegram -->
                                    <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="fab fa-telegram"></i>
                                                    </span>
                                                </span>
                                        </div>
                                        <input type="text" class="form-control border-left-0 bg-transparent pl-0"
                                               name="tg">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- instagram -->
                                    <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="fab fa-instagram"></i>
                                                    </span>
                                                </span>
                                        </div>
                                        <input type="text" class="form-control border-left-0 bg-transparent pl-0"
                                               name="inst">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-success">Добавить</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</main>