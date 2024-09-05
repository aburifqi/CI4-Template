<li class="nav-item menu-items">
    <a class="nav-link" href="pages/forms/basic_elements.html"  onclick="setActiveLinkMenu(this);">
        <div onclick="openPage(261);" data-page="261">
            <?php if($icon): ?>
                <span class="menu-icon">
                    <i class="<?= $icon ?>"<?= $icon_color?'style = "color:'.$icon_color.'"':''?>></i>
                </span>
            <?php endif ?>
            <span class="menu-title"><?= $judul ?></span>
        </div>
    </a>
</li>
