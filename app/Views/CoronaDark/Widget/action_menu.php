<li class="nav-item menu-items">
    <a class="nav-link" href="<?= base_url()?>/page/<?= $id ?>" onclick="openPage(<?= $id ?>);" title ="<?= $judul ?>">
        <?php if($icon): ?>
            <span class="menu-icon">
                <i class="<?= $icon ?>"<?= $icon_color?'style = "color:'.$icon_color.'"':''?>></i>
            </span>
        <?php endif ?>
        <span class="menu-title"><?= $judul ?></span>
    </a>
</li>
