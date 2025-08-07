<div class="sidebar" id='sidebar'>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php if (session()->has('user_id')) : ?>
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input id="search-input" class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" oninput="filterMenu()">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php foreach ($menus as $menu) : ?>
                    <?php
                    // Check if the current page matches the menu item's URL
                    $isActive = (current_url() === base_url($menu->file_name)) ? 'activeted' : '';

                    // Check if menu is visible
                    $visibilityClass = ($menu->visible == 0) ? 'd-none' : '';

                    // Check if user has permission to view the menu
                    $hasPermission = false;
                    foreach ($permission as $perm) {
                        if ($perm->menu_id == $menu->menu_id && $perm->view == 1) {
                            $hasPermission = true;
                            break;
                        }
                    }
                    ?>
                    <?php if ($hasPermission) : ?>
                        <li class="nav-item <?= $visibilityClass ?> menu-item">
                            <a href="<?= base_url($menu->file_name) ?>" class="nav-link <?= $isActive ?>" id="nav-link">
                                <i class="material-symbols-outlined">
                                    <?= $menu->icon ?>
                                </i>
                                <p id="menu-names"><?= $menu->menu_name ?></p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="brand-text font-weight-light">
                    <!-- <p class="sidemenu"><?= lang('app.sidemenu-alert'); ?></p> -->
                    <p class="sidemenu">Silakan login terlebih dahulu</p>
                </div>
            <?php endif; ?>
        </ul>
    </nav>
</div>