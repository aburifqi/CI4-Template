<injectstyle>
    <link href="<?= base_url() ?>libs/spectrum/spectrum.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url() ?>libs/zTreeV3/css/metroStyle/metroStyle.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>libs/datatables/datatables.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>libs/sweetalert2/sweetalert2.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>libs/toast/jquery.toast.min.css" type="text/css">
    <style>
        #treeMenu i{
            font-family: "Font Awesome 6 Brands";
        }
        .tombol-expand:before {
            margin-top: 2px!important;
        }
    
        /* switch Menu */
        .switch-menu {
            position: relative;
            width: 90px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
    
        .switch-menu-checkbox {
            display: none;
        }
    
        .switch-menu-label {
            display: block;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid #999999;
            border-radius: 20px;
        }
    
        .switch-menu-inner {
            display: block;
            width: 200%;
            margin-left: -100%;
            -moz-transition: margin 0.3s ease-in 0s;
            -webkit-transition: margin 0.3s ease-in 0s;
            -o-transition: margin 0.3s ease-in 0s;
            transition: margin 0.3s ease-in 0s;
        }
    
        .switch-menu-inner:before,
        .switch-menu-inner:after {
            display: block;
            float: left;
            width: 50%;
            height: 30px;
            padding: 0;
            line-height: 30px;
            font-size: 14px;
            color: white;
            font-family: Trebuchet, Arial, sans-serif;
            font-weight: bold;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
    
        .switch-menu-inner:before {
            content: "Menu";
            padding-left: 10px;
            background-color: #2FCCFF;
            color: #FFFFFF;
        }
    
        .switch-menu-inner:after {
            content: "Action";
            padding-right: 10px;
            background-color: #EEEEEE;
            color: #999999;
            text-align: right;
        }
    
        .switch-menu-switch {
            display: block;
            width: 18px;
            margin: 6px;
            background: #FFFFFF;
            border: 2px solid #999999;
            border-radius: 20px;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 56px;
            -moz-transition: all 0.3s ease-in 0s;
            -webkit-transition: all 0.3s ease-in 0s;
            -o-transition: all 0.3s ease-in 0s;
            transition: all 0.3s ease-in 0s;
        }
    
        .switch-menu-checkbox:checked+.switch-menu-label .switch-menu-inner {
            margin-left: 0;
        }
    
        .switch-menu-checkbox:checked+.switch-menu-label .switch-menu-switch {
            right: 0px;
        }
    
        /* switch Status */
        .switch-status {
            position: relative;
            width: 90px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
    
        .switch-status-checkbox {
            display: none;
        }
    
        .switch-status-label {
            display: block;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid #999999;
            border-radius: 20px;
        }
    
        .switch-status-inner {
            display: block;
            width: 200%;
            margin-left: -100%;
            -moz-transition: margin 0.3s ease-in 0s;
            -webkit-transition: margin 0.3s ease-in 0s;
            -o-transition: margin 0.3s ease-in 0s;
            transition: margin 0.3s ease-in 0s;
        }
    
        .switch-status-inner:before,
        .switch-status-inner:after {
            display: block;
            float: left;
            width: 50%;
            height: 30px;
            padding: 0;
            line-height: 30px;
            font-size: 11px;
            color: white;
            font-family: Trebuchet, Arial, sans-serif;
            font-weight: normal;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
    
        .switch-status-inner:before {
            content: "Aktif";
            padding-left: 10px;
            background-color: #2FCCFF;
            color: #FFFFFF;
        }
    
        .switch-status-inner:after {
            content: "Non-Aktif";
            padding-right: 10px;
            background-color: #EEEEEE;
            color: #999999;
            text-align: right;
        }
    
        .switch-status-switch {
            display: block;
            width: 18px;
            margin: 6px;
            background: #FFFFFF;
            border: 2px solid #999999;
            border-radius: 20px;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 56px;
            -moz-transition: all 0.3s ease-in 0s;
            -webkit-transition: all 0.3s ease-in 0s;
            -o-transition: all 0.3s ease-in 0s;
            transition: all 0.3s ease-in 0s;
        }
    
        .switch-status-checkbox:checked+.switch-status-label .switch-status-inner {
            margin-left: 0;
        }
    
        .switch-status-checkbox:checked+.switch-status-label .switch-status-switch {
            right: 0px;
        }
    
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent.active {
            display: block;
        }

        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
</injectstyle>

<injectpage>
    <div class="page-header">
        <h3 class="page-title"><?= $info->judul ?></h3>
        <?= view_cell('\App\Libraries\Widget::breadcrumbs', $breadCrumbs) ?>
    </div>
    <div class="row">
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>
                        Daftar Menu 
                        <small>
                            <button type="button" class="btn btn-primary" onclick="tambahMenu(0)">
                                <i class="fa fa-plus"></i>
                            </button>
                        </small>
                    </h4>
                    <div class="clearfix"></div>

                    <div class="table-responsive">
                        <ul id="treeMenu" class="ztree"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <modal id="modal-menu" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Data Menu</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="frm-data">
                        <input type="hidden" name="id" value="0">

                        <div class="row">
                            <div class="col" style="height:60vh; overflow:auto">
                            <div class="form-group">
                                    <label for="name">Kode</label><sup style="color:red">* wajib diisi</sup>
                                    <input type="text" class="form-control" name="name" placeholder="Kode" required>
                                </div>
                                <div class="form-group">
                                    <label for="judul">Judul</label><sup style="color:red">* wajib diisi</sup>
                                    <input type="text" class="form-control" name="judul" placeholder="Judul" required>
                                </div>
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input type="text" class="form-control" name="url" placeholder="URL">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <label for="icon">Icon</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="icon" value="">
                                            <div class="input-group-append">
                                                <button type="button" id="btn-pick-icon" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal-pick-icon"><i class="fa fa-plus"></i>&nbsp;Pilih Icon </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="status">Status</label>
                                        <div class="switch-status">
                                            <input type="checkbox" name="status" class="switch-status-checkbox" id="status" checked>
                                            <label class="switch-status-label" for="status">
                                                <span class="switch-status-inner"></span>
                                                <span class="switch-status-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <label for="color">Warna Icon</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="icon_color" value="">
                                            <div class="input-group-append">
                                                <button type="button" id="btn-pick-warna" class="btn btn-outline-secondary" title="Warna">&nbsp;</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="jenis">Jenis</label>
                                        <div class="switch-menu">
                                            <input type="checkbox" name="jenis" class="switch-menu-checkbox" id="jenis" checked>
                                            <label class="switch-menu-label" for="jenis">
                                                <span class="switch-menu-inner"></span>
                                                <span class="switch-menu-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="is_page">Ada Halaman</label>
                                        <input type="checkbox" name="is_page" class="form_control" id="is_page" checked>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="description">Keterangan</label>
                                        <textarea name = "description" class = "form-control" id = "description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-save" onclick="simpanMenu(this);">Simpan</button>
                </div>
            </div>
        </div>
    </modal>
    
    <modal id="modal-pick-icon" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    PILIH ICON
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" align="center">
                    <div class="table-responsive">
                        <table id="tbl-icons" level="0" class="table table-striped table-hover jambo_table" width="100%">
                            <thead>
                                <tr>
                                    <th field-name="id" format-data="row-number" filter-type="toggle-filter"  class-name="dt-body-right" width="50px" no-order = "1"><center>No</center></th>
    
                                    <th field-name="nama" filter-type="input" format-data="custom" format-custom="columnIcon" class-name="dt-body-center"><center>Icon</center></th>
    
                                    <th field-name="font" filter-type="select" filter-option="optionFonts" ><center>Font</center></th>
    
                                    <th field-name="kode" filter-type="input"><center>Kode Icon</center></th>
    
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btn-modal-pilih-icon" type="button" class="btn btn-danger" data-dismiss="modal">Pilih</button>
                </div>
            </div>
        </div>
    </modal>
</injectpage>

<injectscript>
    <script src="<?= base_url() ?>libs/spectrum/spectrum.min.js"></script>

    <script type="text/javascript" src="<?= base_url() ?>libs/zTreeV3/js/jquery.ztree.core.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>libs/zTreeV3/js/jquery.ztree.excheck.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>libs/zTreeV3/js/jquery.ztree.exedit.js"></script>
    <script src="<?= base_url(); ?>/libs/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= base_url(); ?>/libs/toast/jquery.toast.min.js"></script>
    <script src="<?= base_url(); ?>/libs/datatables/datatables.min.js"></script>
    <script src="<?= base_url(); ?>/libs/datatables/custom-data-tables.js"></script>
    <script src="<?= base_url() ?>/scripts/pengaturan/desain-menu.js"></script>

</injectscript>