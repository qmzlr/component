<?php

$this->layout('layoutHead', ['title' => 'Profile']);
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
            <i class='subheader-icon fal fa-user'></i> <?= $user['username']; ?>
        </h1>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-6 m-auto">
            <!-- profile summary -->
            <div class="card mb-g rounded-top">
                <div class="row no-gutters row-grid">
                    <div class="col-12">
                        <div class="d-flex flex-column align-items-center justify-content-center p-4">
                            <img src="<?= $user['avatar']; ?>"
                                 class="rounded-circle shadow-2 img-thumbnail" alt="Аватарка">
                            <h5 class="mb-0 fw-700 text-center mt-3">
                                <?= $user['username']; ?>
                                <small class="text-muted mb-0"><?= $user['job']; ?></small>
                            </h5>
                            <div class="mt-4 text-center demo">
                                <a href="javascript:void(0);" class="fs-xl" style="color:#C13584">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="javascript:void(0);" class="fs-xl" style="color:#4680C2">
                                    <i class="fab fa-vk"></i>
                                </a>
                                <a href="javascript:void(0);" class="fs-xl" style="color:#0088cc">
                                    <i class="fab fa-telegram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 text-center">
                            <a href="tel:+<?= $user['phone']; ?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mobile-alt text-muted mr-2"></i> <?= $user['phone']; ?></a>
                            <a href="mailto:<?= $user['email']; ?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mouse-pointer text-muted mr-2"></i> <?= $user['email']; ?></a>
                            <address class="fs-sm fw-400 mt-4 text-muted">
                                <i class="fas fa-map-pin mr-2"></i> <?= $user['address']; ?>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>