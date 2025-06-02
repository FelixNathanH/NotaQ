<!DOCTYPE html>
<html lang="<?= session()->get('language') ?? 'en' ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->renderSection('links'); ?>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/font-awesome-animation.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/font-awesome.min.css') ?>">

    <!-- CSS W3S -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/jqvmap/jqvmap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/dist/css/adminlte.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/summernote/summernote-bs4.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google material -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body class="layout-fixed" style="height: auto;">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <div class="loader"></div>
            <div class="success-icon"></div>
            <div class="error-icon"></div>
            <div class="loader-content">
                <h1 class="loader-message">Loading, mohon tunggu sebentar...</h1>
            </div>
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Top navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Theme -->
                <?php $currentLanguage = session()->get('language') ?? 'en'; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" role="button" data-toggle="dropdown">
                        <i id="themeIcon" class="fas"></i>
                        <span id="themeText"></span>
                    </a>
                    <div class=" dropdown-menu" aria-labelledby="themeDropdown">
                        <a class="dropdown-item" href="#" id="lightMode">Light Mode</a>
                        <a class="dropdown-item" href="#" id="darkMode">Dark Mode</a>
                    </div>
                </li>
                <!-- Language -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        <i class="fas fa-globe"></i>
                        <?= ($currentLanguage === 'en') ? 'EN' : 'ID' ?>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url('/change-language/en') ?>">English/En</a>
                        <a class="dropdown-item" href="<?= base_url('/change-language/indo') ?>">Indonesian/Id</a>
                        <a class="dropdown-item" href="<?= base_url('/addLanguage') ?>"> +Add language</a>
                    </div>
                </li> -->
                <!-- Time -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span id="timeLabel">Waktu sekarang: </span>
                        <span id="clock"></span>
                    </a>
                </li>
                <!-- Profile -->
                <li class="nav-item dropdown">
                    <?php if (!empty($name)) : ?>
                        <a class="nav-link welcome-text" data-toggle="dropdown" href="#" id="welcome-text">
                            <p>Welcome back, <?= $name; ?></p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="<?= base_url('/myprofile') ?>" class="dropdown-item dropdown-footer">Edit Profile</a>
                            <!-- <a href="<?= base_url('/logout') ?>" class="dropdown-item dropdown-footer">Log-out</a> -->
                        </div>
                    <?php else : ?>
                        <a href="<?= base_url('/login') ?>" class="nav-link">
                            <p>Log-in</p>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->


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
                                    <li class="nav-item">
                                        <a href="<?= base_url('/staff') ?>" class="nav-link">
                                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                                            <p id="menu-names">
                                                Staff List
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('/product') ?>" class="nav-link">
                                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                                            <p id="menu-names">
                                                Product List
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('/invoice') ?>" class="nav-link">
                                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                                            <p id="menu-names">
                                                Invoice
                                            </p>
                                        </a>
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
                </nav>
            </div>
            <!-- Bottom: Logout -->
            <?php if (session()->has('user_id')) : ?>
                <div class="logout-container">
                    <div class="p-3">
                        <a href="<?= base_url('/logout') ?>" class="btn btn-danger btn-block">
                            <i class="fas fa-sign-out-alt"></i> Log-out
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </aside>
        <!-- /.sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <?php if (session()->has('user_id')) : ?>
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <?= $this->renderSection('content'); ?>
                    </div>
                </section>
            </div>
        <?php else : ?>
            <div class="login-req">
                <h1>
                    <!-- <?= lang('app.login-require') ?> -->
                    Tolong lakukan login pada kanan atas halaman sebulum melihat halaman utama
                </h1>
            </div>
        <?php endif; ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('asset/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- ChartJS -->
    <script src="<?= base_url('asset/AdminLTE/plugins/chart.js/Chart.min.js') ?>"></script>
    <!-- Sparkline -->
    <script src="<?= base_url('asset/AdminLTE/plugins/sparklines/sparkline.js') ?>"></script>
    <!-- JQVMap -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
    <script src="<?= base_url('asset/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('asset/AdminLTE/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('asset/AdminLTE/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('asset/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
    <!-- Summernote -->
    <script src="<?= base_url('asset/AdminLTE/plugins/summernote/summernote-bs4.min.js') ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('asset/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('asset/AdminLTE/dist/js/adminlte.js') ?>"></script>
    <!-- Script Ganti Theme -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.body;
            const themeIcon = document.getElementById('themeIcon');
            const themeText = document.getElementById('themeText');
            const lightMode = document.getElementById('lightMode');
            const darkMode = document.getElementById('darkMode');
            const navbar = document.querySelector('.navbar'); // Navbar
            const sidebar = document.querySelector('.main-sidebar'); // Sidebar element
            const sidemenu = document.querySelector('.sidemenu'); // Sidemenu element

            // Function to set the theme
            function setTheme(theme) {
                if (theme === 'dark') {
                    body.classList.add('dark-mode');
                    navbar.classList.add('navbar-dark', 'bg-dark');
                    navbar.classList.remove('navbar-light', 'bg-light');
                    sidebar.classList.add('sidebar-dark-primary');
                    sidebar.classList.remove('sidebar-light-primary');
                    themeIcon.classList.replace('fa-moon', 'fa-sun');
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-lightbulb');
                    themeText.textContent = 'Dark Mode';
                    localStorage.setItem('theme', 'dark');
                } else {
                    body.classList.remove('dark-mode');
                    navbar.classList.add('navbar-light', 'bg-light');
                    navbar.classList.remove('navbar-dark', 'bg-dark');
                    sidebar.classList.add('sidebar-light-primary');
                    sidebar.classList.remove('sidebar-dark-primary');
                    themeIcon.classList.replace('fa-sun', 'fa-moon');
                    themeIcon.classList.remove('fa-lightbulb');
                    themeIcon.classList.add('fa-sun');
                    themeText.textContent = 'Light Mode';
                    localStorage.setItem('theme', 'light');
                }
            }

            // Check for saved user preference and apply it
            const savedTheme = localStorage.getItem('theme') || 'light';
            setTheme(savedTheme);

            // Event listeners for the dropdown items
            lightMode.addEventListener('click', function() {
                setTheme('light');
            });

            darkMode.addEventListener('click', function() {
                setTheme('dark');
            });
        });
    </script>
    <!-- Script Welcome Text -->
    <script>
        function adjustWelcomeText() {
            var welcomeTextElement = document.getElementById('welcome-text');
            var username = "<?= $name; ?>";
            if (window.innerWidth <= 576) { // Adjust the width as needed
                welcomeTextElement.textContent = username;
            } else {
                welcomeTextElement.textContent = "Welcome back, " + username;
            }
        }

        // Run the function on page load and when the window is resized
        window.onload = adjustWelcomeText;
        window.onresize = adjustWelcomeText;
    </script>
    <!-- Scripts search bar -->
    <script>
        function filterMenu() {
            const searchInput = document.getElementById('search-input').value.toLowerCase();
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                const menuName = item.querySelector('p').textContent.toLowerCase(); // Changed to select <p>
                if (menuName.includes(searchInput)) {
                    item.style.display = 'block'; // Show item
                } else {
                    item.style.display = 'none'; // Hide item
                }
            });
        }
    </script>
    <!-- Scripts clock -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateClock() {
                const clockElement = document.getElementById('clock');
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                clockElement.textContent = `${hours}:${minutes}:${seconds}`;
            }

            // Update the clock immediately, then every second
            updateClock();
            setInterval(updateClock, 1000);
        });
    </script>
    <?= $this->renderSection('scripts'); ?>
</body>

</html>