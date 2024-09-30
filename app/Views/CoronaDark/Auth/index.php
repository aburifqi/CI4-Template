<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--favicon-->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>Corona Dark</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/libs/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/coronadark/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>/coronadark/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/favicon.png" />

    <?= $this->renderSection('style') ?>
  </head>
  <body>
    <div class="container-scroller">
        <?= $this->renderSection('page-content') ?>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?= $this->renderSection('modals') ?>
    <!-- plugins:js -->
    <!-- <script src="<?= base_url(); ?>/coronadark/js/vendor.bundle.base.js"></script> -->
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <!-- <script src="<?= base_url(); ?>/coronadark/js/off-canvas.js"></script> -->
    <!-- <script src="<?= base_url(); ?>/coronadark/js/hoverable-collapse.js"></script> -->
    <!-- <script src="<?= base_url(); ?>/coronadark/js/misc.js"></script> -->
    <!-- <script src="<?= base_url(); ?>/coronadark/js/settings.js"></script> -->
    <!-- <script src="<?= base_url(); ?>/coronadark/js/todolist.js"></script> -->
    <!-- <script src="<?= base_url(); ?>/standard/jquery-cookie/jquery-cookie.js"></script> -->
    <!-- endinject -->
    <?= $this->renderSection('scripts') ?>
  </body>
</html>