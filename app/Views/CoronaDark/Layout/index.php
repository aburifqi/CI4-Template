<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--favicon-->
    <link rel="icon" href="<?= base_url(); ?>/coronadark/images/favicon.ico" type="image/x-icon">
    <title>CORONA DARK</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/standard/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/coronadark/css/vendor.bundle.base.css">
    <!-- endinject -->
    <link href="<?= base_url(); ?>/fonts/font-awesome/css/all.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/fonts/font-awesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/datepicker/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/toast/jquery.toast.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/sweetalert2/sweetalert2.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url(); ?>/gentelella/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?= base_url(); ?>/gentelella/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css"
      rel="stylesheet">
    <link href="<?= base_url(); ?>/datatables/datatables.min.css" rel="stylesheet" />
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>/coronadark/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= base_url(); ?>/coronadark/images/favicon.ico" />

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
        .collapse:not(.show){
          display:none !important;
        }

    </style>
    <?= $this->renderSection('style') ?>
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
          <div class="content-wrapper">
              <div id="page-element">
                <div class="page-header">
                  <h3 class="page-title"></h3>
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Manajemen Akun</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Grup Pengguna</li>
                      </ol>
                  </nav>
              </div>
              <div class="row">
                  <div class="col grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                            <div id="data-display">
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <!-- partial:partials/_footer.html -->
          <?= $this->include('CoronaDark/Layout/Partials/footer'); ?>
          <!-- partial -->
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <modals>
      
    </modals>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url(); ?>/coronadark/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url(); ?>/coronadark/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>/coronadark/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>/coronadark/js/misc.js"></script>
    <script src="<?= base_url(); ?>/coronadark/js/settings.js"></script>
    <script src="<?= base_url(); ?>/standard/jquery-cookie/jquery-cookie.js"></script>
    <script src="app/views/coronadark/basic/assets/js/menu.js"></script>
    <script src="app/scripts/common/common.js"></script>
    <script src="<?= base_url(); ?>/jquery-auto-numeric/autoNumeric.js"></script>

    <script src="<?= base_url(); ?>/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>/toast/jquery.toast.min.js"></script>
    <script src="<?= base_url(); ?>/sweetalert2/sweetalert2.all.min.js"></script>

    <script src="<?= base_url(); ?>/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url(); ?>/moment/moment-with-locales.min.js"></script>
    <!-- <script src="<?= base_url(); ?>/bootstrap-autocomplete/bootstrap-autocomplete.min.js"></script> -->
    <script src="<?= base_url(); ?>/gentelella/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="<?= base_url(); ?>/gentelella/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="<?= base_url(); ?>/datatables/datatables.min.js"></script>

    <script>
      var listItemPerPage = <?= $general['listitemperpage'] ?>;
    </script>
    <script src="app/scripts/common/custom-data-tables.js"></script>
    <div id="inject-js">
    </div>
  </body>
</html>