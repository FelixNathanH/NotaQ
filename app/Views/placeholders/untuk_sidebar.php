<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('/') ?>" class="brand-link">
        <img src="asset/img/Logo.png" alt="NotaQueue Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            <h4 style="display: inline;">Nota</h4>
            <h4 id="brand-text-system">Queue</h4>
        </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" id='sidebar'>
        <!-- Sidebar user company  (Nama toko) -->
        <?php if (session()->has('user_id')) : ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info" style="width: 100%;">
                    <a class="d-block text-center fw-bold"><?= $company; ?></a>
                </div>
            </div>
        <?php else : ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a class="d-block text-center fw-bold">Silakan Log-in terlebih dahulu</a>
                </div>
            </div>
        <?php endif; ?>
        <!-- Sidebar Menu -->
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
                    <!-- Placeholders untuk menu -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v1</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v3</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- /.Placeholders untuk menu -->
                <?php else : ?>
                    <div class="brand-text font-weight-light">
                        <!-- <p class="sidemenu"><?= lang('app.sidemenu-alert'); ?></p> -->
                        <p class="sidemenu">Silakan login terlebih dahulu</p>
                    </div>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>

<!-- v2 -->
<aside class="main-sidebar">
    <div class="sidebar-menu">
        <a href="<?= base_url('/') ?>" class="brand-link">
            <img src="asset/img/Logo.png" alt="NotaQueue Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">
                <h4 style="display: inline;">Nota</h4>
                <h4 id="brand-text-system">Queue</h4>
            </span>
        </a>
        <!-- Sidebar user company  (Nama toko) -->
        <?php if (session()->has('user_id')) : ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info" style="width: 100%;">
                    <a class="d-block text-center fw-bold"><?= $company; ?></a>
                </div>
            </div>
        <?php else : ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a class="d-block text-center fw-bold">Silakan Log-in terlebih dahulu</a>
                </div>
            </div>
        <?php endif; ?>

        <ul class="nav flex-column">
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
                        <!-- Placeholders untuk menu -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./index.html" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./index2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./index3.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- /.Placeholders untuk menu -->
                    <?php else : ?>
                        <div class="brand-text font-weight-light">
                            <!-- <p class="sidemenu"><?= lang('app.sidemenu-alert'); ?></p> -->
                            <p class="sidemenu">Silakan login terlebih dahulu</p>
                        </div>
                    <?php endif; ?>
                </ul>
            </nav>
        </ul>
    </div>
    <div class="logout-button">
        <a href="#" class="btn btn-danger w-100">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</aside>

<!-- v3 -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('/') ?>" class="brand-link">
        <img src="asset/img/Logo.png" alt="NotaQueue Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            <h4 style="display: inline;">Nota</h4>
            <h4 id="brand-text-system">Queue</h4>
        </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" id='sidebar'>
        <!-- Sidebar user company  (Nama toko) -->
        <?php if (session()->has('user_id')) : ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info" style="width: 100%;">
                    <a class="d-block text-center fw-bold"><?= $company; ?></a>
                </div>
            </div>
        <?php else : ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a class="d-block text-center fw-bold">Silakan Log-in terlebih dahulu</a>
                </div>
            </div>
        <?php endif; ?>
        <!-- Sidebar Menu -->
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
                    <!-- Placeholders untuk menu -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v1</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v3</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- /.Placeholders untuk menu -->
                <?php else : ?>
                    <div class="brand-text font-weight-light">
                        <!-- <p class="sidemenu"><?= lang('app.sidemenu-alert'); ?></p> -->
                        <p class="sidemenu">Silakan login terlebih dahulu</p>
                    </div>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>