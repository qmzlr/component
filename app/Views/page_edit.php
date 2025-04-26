<?php
$this->layout('layoutHead', ['title' => 'Edit']);
$this->push('styles') ?>
<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="../../resource/css/vendors.bundle.css">
<link id="appbundle" rel="stylesheet" media="screen, print" href="../../resource/css/app.bundle.css">
<link id="myskin" rel="stylesheet" media="screen, print" href="../../resource/css/skins/skin-master.css">
<link rel="stylesheet" media="screen, print" href="../../resource/css/fa-solid.css">
<link rel="stylesheet" media="screen, print" href="../../resource/css/fa-brands.css">
<?php
$this->end();

$this->push('scripts') ?>

<script src="../../resource/js/vendors.bundle.js"></script>
<script src="../../resource/js/app.bundle.js"></script>
<script>

    $(document).ready(function () {

        $('input[type=radio][name=contactview]').change(function () {
            if (this.value == 'grid') {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                $('#js-contacts .js-expand-btn').addClass('d-none');
                $('#js-contacts .card-body + .card-body').addClass('show');

            } else if (this.value == 'table') {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                $('#js-contacts .js-expand-btn').removeClass('d-none');
                $('#js-contacts .card-body + .card-body').removeClass('show');
            }

        });

        //initialize filter
        initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
    });

</script>
<?php
$this->end();
?>


<main id="js-page-content" role="main" class="page-content mt-3">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
        </h1>

    </div>
    <form action="/edit" method="post">
        <div class="row">
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Общая информация</h2>
                        </div>
                        <div class="panel-content">
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Имя</label>
                                <input type="text" id="simpleinput" class="form-control" name="username"
                                       value="<?= $user['username']
                                       ?>">
                            </div>

                            <!-- title -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Место работы</label>
                                <input type="text" id="simpleinput" class="form-control" name="job"
                                       value="<?= $user['job'] ?>">
                            </div>

                            <!-- tel -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Номер телефона</label>
                                <input type="text" id="simpleinput" class="form-control" name="phone"
                                       value="<?= $user['phone']
                                       ?>">
                            </div>

                            <!-- address -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Адрес</label>
                                <input type="text" id="simpleinput" name="address" class="form-control"
                                       value="<?= $user['address'] ?>">
                            </div>
                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button class="btn btn-warning">Редактировать</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

