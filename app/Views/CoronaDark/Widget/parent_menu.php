<li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="javascript:void(0);" aria-expanded="false" aria-controls="ui-basic" title = "<?= $menu['judul'] ?>">
        <?php if($menu['icon']): ?>
            <span class="menu-icon">
                <i class="<?= $menu['icon'] ?>" <?= $menu['icon_color']?'style = "color:'.$menu['icon_color'].'"':''?>></i>
            </span>
        <?php endif ?>
        <span class="menu-title"><?= $menu['judul'] ?></span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse">
        <ul class="nav flex-column sub-menu">
            <?= $menuAnak ?>
        </ul>
    </div>
</li>