<?php
$this->layout('layoutHead', ['title' => 'Аватарка']) ?>

<?php $this->push('styles') ?>
<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="../../resource/css/vendors.bundle.css">
<link id="appbundle" rel="stylesheet" media="screen, print" href="../../resource/css/app.bundle.css">
<link id="myskin" rel="stylesheet" media="screen, print" href="../../resource/css/skins/skin-master.css">
<link rel="stylesheet" media="screen, print" href="../../resource/css/fa-solid.css">
<link rel="stylesheet" media="screen, print" href="../../resource/css/fa-brands.css">

<?php $this->end(); ?>
<?php $this->push('scripts') ?>

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
<?php $this->end(); ?>

<main id="js-page-content" role="main" class="page-content mt-3">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-image'></i> Загрузить аватар
        </h1>

    </div>
    <form action="/mediaUpdate" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Текущий аватар</h2>
                        </div>
                        <div class="panel-content">
                            <div class="form-group">
                                <img src="<?= $user['avatar'] ?>" alt="Avatar" class="img-responsive"
                                     width="200">
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <label class="form-label" for="example-fileinput">Выберите аватар</label>
                                <input type="file" id="example-fileinput" name="avatar" class="form-control-file"
                                       required>
                            </div>


                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button class="btn btn-warning">Загрузить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
