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
        <h3 class="page-title"><?= $info->judul ?></h3>
        <?= view_cell('\App\Libraries\Widget::breadcrumbs', $breadCrumbs) ?>
    </div>
    <div class="row">
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl-data" sumber = "list-<?= $info->name ?>" level="0" class="table table-striped table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th field-name="id" filter-type="toggle-filter" format-data="row-number" class-name="dt-body-right" width="50px" no-order = "1">No.</th>

                                    <th field-name="name" filter-type="input">
                                        <center>Grup</center>
                                    </th>

                                    <th field-name="description" filter-type="input">
                                        <center>Keterangan</center>
                                    </th>

                                    <th field-name="null" format-data="custom" format-custom="actionColumn" class-name="dt-body-center" width="150px">
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
    <script>
        var izinTambah = '<?= $izinTambah; ?>';
        var izinEdit = '<?= $izinEdit; ?>';
        var izinHapus = '<?= $izinHapus; ?>';
        var izinLihat = '<?= $izinLihat; ?>';
    </script>
    <script src="<?= base_url(); ?>/libs/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>/libs/datatables/datatables.min.js"></script>
    <script src="<?= base_url(); ?>/libs/datatables/custom-data-tables.js"></script>
    <script src="<?= base_url() ?>/scripts/common/list.js"></script>

</injectscript>