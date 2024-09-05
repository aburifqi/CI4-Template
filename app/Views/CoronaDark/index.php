<?= $this->extend('coronadark/layout/index') ?>

<?= $this->section('style') ?>
    <style>
    </style>
<?= $this->endSection() ?>

<?= $this->section('page-content') ?>

<?= $this->endSection() ?>

<?= $this->section('modals') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const baseURL = '<?= base_url() ?>';
</script>
<!-- <script src="<?= base_url(); ?>/standard/jquery-validation/jquery.validate.min.js"></script> -->
<script src="<?= base_url(); ?>/scripts/index.js"></script>

<?= $this->endSection() ?>