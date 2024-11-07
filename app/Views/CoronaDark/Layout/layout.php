<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--favicon-->
    <link rel="icon" href="<?= base_url(); ?>/coronadark/images/favicon.png" type="image/x-icon">
    <title><?= getenv("APPNAME"); ?></title>

    <link href="<?= base_url(); ?>/fonts/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url(); ?>/libs/mdi/css/materialdesignicons.min.css">
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>/libs/bootstrap-4.0.0/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>/libs/bootstrap-5.3.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>/libs/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/coronadark/css/vendor.bundle.base.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>/coronadark/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= base_url(); ?>/coronadark/images/favicon.png" />

    <style>
        .main-panel {
            min-height: 100vh!important;
            max-height: 100vh;
        }

        .content-wrapper {
            overflow: auto;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgb(90, 156, 226);
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        /* .collapse:not(.show){
          display:none !important;
        } */

    </style>
    <?= $this->renderSection('style') ?>
    <injectstyle></injectstyle>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <?= $this->include('CoronaDark/Layout/Partials/sidebar'); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <?=  $this->include('CoronaDark/Layout/Partials/navbar'); ?>
        <!-- partial -->
        <div class="main-panel">
          <div  id="page-element" class="content-wrapper">
            
          </div>
          <!-- partial:partials/_footer.html -->
          <?= $this->include('CoronaDark/Layout/Partials/footer'); ?>
          <!-- partial -->
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script>
      const baseURL = '<?= base_url(); ?>';
    </script>

    <script src="<?= base_url(); ?>/coronadark/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url(); ?>/fonts/font-awesome/6.4.0/js/all.min.js"></script>
    <!-- <script src="<?= base_url(); ?>/libs/bootstrap-5.3.3/js/bootstrap.min.js"></script> -->
    <!-- <script src="<?= base_url(); ?>/libs/bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="<?= base_url(); ?>/libs/bootstrap-4.0.0/js/bootstrap.min.js"></script> -->
    <script src="<?= base_url(); ?>/libs/bootstrap-4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/coronadark/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>/coronadark/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>/coronadark/js/misc.js"></script>
    <script src="<?= base_url(); ?>/coronadark/js/settings.js"></script>
    <script src="<?= base_url(); ?>/coronadark/js/custom.js"></script>
    <script src="<?= base_url(); ?>/coronadark/js/index.js"></script>
    <?= $this->renderSection('scripts') ?>
    <injectscript></injectscript>
  </body>
</html>