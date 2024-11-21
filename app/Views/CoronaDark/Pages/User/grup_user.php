<?php
    $izinLihat = in_array('lihat_grup_user', $otoritas);
    $izinTambah = in_array('tambah_grup_user', $otoritas);
    $izinEdit = in_array('edit_grup_user', $otoritas);
    $izinHapus = in_array('hapus_grup_user', $otoritas);
?>
<injectstyle>
</injectstyle>

<injectpage>
    <div class="page-header">
        <h3 class="page-title"><?= $data->judul ?></h3>
        <?= view_cell('\App\Libraries\Widget::breadcrumbs', $breadCrumbs) ?>
    </div>
    <div class="row">
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl-data" level="0" class="table table-striped table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th field-data="null" field-name="id" filter-type="toggle-filter" data-format="row-number" class-name="dt-body-right" width="50px">No.</th>

                                    <th field-data="grup" field-name="grup" filter-type="input" data-format="custom" custom-func="grupColumn">
                                        <center>Grup</center>
                                    </th>

                                    <th field-data="status" field-name="status" filter-type="select" option-function="statusOption" data-format="custom" custom-func="statusColumn" class-name="dt-body-center"  width="150px">
                                        <center>Status</center>
                                    </th>

                                    <th field-data="null" field-name="null" data-format="custom" custom-func="actionColumn" class-name="dt-body-center" width="150px">
                                        <center>
                                            Aksi
                                            <?php if($izinTambah): ?>
                                                <br />
                                                <button type="button" class="btn-new-data btn btn-sm btn-primary" onclick="newData(this,0);">
                                                    <i class="mdi mdi-plus"></i>
                                                </button>
                                            <?php endif ?>
                                        </center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</injectpage>

<injectscript>
    <script src="<?= base_url(); ?>/libs/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>/libs/datatables/datatables.min.js"></script>
    <script src="<?= base_url(); ?>/libs/datatables/custom-data-tables.js"></script>
    <script src="<?= base_url() ?>/scripts/common/list.js"></script>

</injectscript>