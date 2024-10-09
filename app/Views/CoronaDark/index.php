<?= $this->extend('coronadark/layout/layout') ?>

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
    const directOpenPage = '<?= $page ?? ''?>';
</script>
<script src="<?= base_url(); ?>/scripts/index.js"></script>

<?= $this->endSection() ?>