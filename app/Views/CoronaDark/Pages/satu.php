
<div class="page-header">
    <h3 class="page-title"><?= $data->judul ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php if(sizeof($breadCrumbs)):?>
                <?php foreach($breadCrumbs as $i=>$bc):?>
            
                    <?php if($i >= sizeof($breadCrumbs)-1):?>
                        <li class="breadcrumb-item active" aria-current="page"><?= $bc->judul ?></li>
                    <?php else: ?>
                        <?php if($bc->is_page): ?>
                            <li class="breadcrumb-item"><a href="<?= base_url()?>/page/<?= $bc->id ?>?>" onclick = "openPage(<?= $bc->id ?>)"><?= $bc->judul ?></a></li>
                        <?php else: ?>
                            <li class="breadcrumb-item"><a href="javacript:void(0);"><?= $bc->judul ?></a></li>
                        <?php endif ?>
                    <?php endif ?>
                <?php endforeach ?>
            <?php endif ?>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            </div>
        </div>
    </div>
</div>