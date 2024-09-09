<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php if(sizeof($breadCrumbs)):?>
            <?php foreach($breadCrumbs as $i=>$bc):?>

                <?php if($i >= sizeof($breadCrumbs)-1):?>
                    <li class="breadcrumb-item active" aria-current="page"><?= $bc->judul ?></li>
                <?php else: ?>
                    <li class="breadcrumb-item"><a href="<?= base_url()?>/page/<?= $bc->id ?>?>"
                        onclick="openPage(<?= $bc->id ?>)"><?= $bc->judul ?></a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        <?php endif ?>
    </ol>
</nav>