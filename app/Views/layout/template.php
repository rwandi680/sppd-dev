<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>GeserAPP | <?= $title ?></title>

    <link href="<?= site_url() ?>public/assets/font/mdi/css/materialdesignicons.css" rel="stylesheet" />
    <link href="<?= site_url() ?>public/assets/font/roboto/roboto.css" rel="stylesheet" />

    <!-- PLUGINS CSS STYLE -->
    <link href="<?= site_url() ?>public/assets/plugins/datatables/datatables.min.css" rel="stylesheet" />
    <link href="<?= site_url() ?>public/assets/plugins/toaster/toastr.min.css" rel="stylesheet" />
    <link href="<?= site_url() ?>public/assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
    <link href="<?= site_url() ?>public/assets/plugins/ladda/ladda.min.css" rel="stylesheet" />
    <link href="<?= site_url() ?>public/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="<?= site_url() ?>public/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="<?= site_url() ?>public/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="<?= site_url() ?>public/assets/css/sleek.css" />
    <link id="sleek-css" rel="stylesheet" href="<?= site_url() ?>public/assets/css/custom.css" />

    <!-- FAVICON -->
    <link href="<?= site_url() ?>public/assets/img/favicon/favicon.ico" rel="shortcut icon" />
    <script src="<?= site_url() ?>public/assets/plugins/nprogress/nprogress.js"></script>
</head>


<body class="sidebar-fixed sidebar-minified sidebar-dark header-fixed header-light" id="body">
    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();
    </script>

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">

        <!--
                    ====================================
                    ——— LEFT SIDEBAR WITH OUT FOOTER
                    =====================================
                  -->
        <aside class="left-sidebar bg-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="#" style="margin-left: -10px;">
                        <img src="<?= site_url() ?>public/assets/img/logo.png" alt="logo_pnd" style="width: 45px;">
                        <span class="brand-name">GeserAPP</span>
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-scrollbar">

                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">
                        <?php

                        $role =  session('ses_role');
                        $db = \Config\Database::connect();
                        $qMenu = $db->query("SELECT tbl_menu.id_menu, menu, icon, link, sub_menu 
                    FROM tbl_menu
                    JOIN tbl_menu_akses ON tbl_menu.id_menu = tbl_menu_akses.id_menu 
                    WHERE tbl_menu_akses.id_role = '$role'
                    GROUP BY tbl_menu.id_menu
                    ORDER BY menu_order ASC
                    ");

                        foreach ($qMenu->getResult() as $menu) {
                            if ($menu->sub_menu == 'TRUE') {
                                $qSubMenu = $db->query("SELECT sub_menu, link 
                            FROM tbl_sub_menu
                            JOIN tbl_menu_akses ON tbl_sub_menu.id_sub_menu = tbl_menu_akses.id_sub_menu 
                            WHERE tbl_menu_akses.id_role = '$role' AND tbl_sub_menu.id_menu = '$menu->id_menu'
                            ORDER BY sub_order ASC
                            ");
                                echo '
                            <li class="has-sub">
                                <a href="javascript:void(0);" class="sidenav-item-link" data-toggle="collapse" data-target="#' . $menu->id_menu . '" aria-expanded="false" aria-controls="' . $menu->id_menu . '">
                                    <i class="' . $menu->icon . '"></i>
                                    <span class="nav-text">' . $menu->menu . '</span> <b class="caret"></b>
                                </a>
                                <ul class="collapse" id="' . $menu->id_menu . '" data-parent="#sidebar-menu">
                                    <div class="sub-menu">';
                                foreach ($qSubMenu->getResult() as $subMenu) {
                                    echo '<li>
                                        <a href="' . site_url($subMenu->link) . '" class="sidenav-item-link">
                                                <span class="nav-text">' . $subMenu->sub_menu . '</span>
                                        </a>
                                    </li>';
                                }
                                echo '
                                    </div>
                                </ul>
                            </li>
                            ';
                            } else {
                                echo '
                            <li>
                                <a href="' . site_url($menu->link) . '" class="sidenav-item-link">
                                    <i class="' . $menu->icon . '"></i>
                                    <span class="nav-text">' . $menu->menu . '</span>
                                </a>
                            </li>
                            ';
                            }
                        }
                        ?>
                    </ul>

                </div>
            </div>
        </aside>
        <div class="page-wrapper">
            <!-- Header -->
            <header class="main-header " id="header">
                <nav class="navbar navbar-static-top navbar-expand-lg">
                    <!-- Sidebar toggle button -->
                    <button id="sidebar-toggler" class="sidebar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                    </button>

                    <?= form_open('auth/gantiTahun', ['id' => 'formGantiTahun', 'method' => 'POST']) ?>
                    <select name="xtahun" id="gantiTahun" class="ml-2 form-control" style="width: 7em;">
                        <?php
                        $xthn = session('ses_tahun');
                        $qThn = $db->query("SELECT tahun FROM tbl_tahun");
                        foreach ($qThn->getResult() as $t) {
                            $selected = ($t->tahun == $xthn) ? ' selected="selected"' : "";

                            echo '<option value="' . $t->tahun . '" ' . $selected . '>' . $t->tahun . '</option>';
                        }
                        ?>
                    </select>
                    <?= form_close() ?>

                    <div class="navbar-right ml-auto">
                        <ul class="nav navbar-nav">
                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <img src="<?= site_url() ?>public/assets/img/user/user.png" class="user-image" alt="User Image" />
                                    <span class="d-none d-lg-inline-block">Username</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <!-- User image -->
                                    <li>
                                        <a href="profile.html">
                                            <i class="mdi mdi-account"></i> Profile
                                        </a>
                                        <a href="<?= site_url('auth/logout') ?>"> <i class="mdi mdi-logout"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- KOnten -->
            <div class="content-wrapper">
                <div class="content">
                    <div class="breadcrumb-wrapper">
                        <h1><?= $title ?></h1>
                    </div>

                    <!-- Content Render -->
                    <?php echo $this->renderSection('content'); ?>

                </div>
            </div>

            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        &copy; <span id="copy-year">2019</span> | Sistem Informasi Manajemen Pergeseran Anggaran by
                        <a class="text-primary" href="https://bpkd.pangandarankab.go.id/" target="_blank">BPKD Kab. Pangandaran</a>.
                    </p>
                </div>
                <script>
                    var d = new Date();
                    var year = d.getFullYear();
                    document.getElementById("copy-year").innerHTML = year;
                </script>
            </footer>

        </div>
    </div>

    <script src="<?= site_url() ?>public/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/datatables/datatables.min.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/datatables/filterdropdown.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/toaster/toastr.min.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/ladda/spin.min.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/ladda/ladda.min.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/jquery-mask-input/jquery.mask.min.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?= site_url() ?>public/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?= site_url() ?>public/assets/js/sleek.js"></script>
    <script src="<?= site_url() ?>public/assets/js/date-range.js"></script>
    <script src="<?= site_url() ?>public/assets/js/custom.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            // Date Picker
            $(".datepicker").daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
                showDropdowns: false,
                autoUpdateInput: true
            });

            // Select2
            $('.select2').select2();
            $('body').on('shown.bs.modal', '.modal', function() {
                $(this).find('select').each(function() {
                    var dropdownParent = $(document.body);
                    if ($(this).parents('.modal.in:first').length !== 0)
                        dropdownParent = $(this).parents('.modal.in:first');
                    $(this).select2({
                        dropdownParent: dropdownParent
                        // ...
                    });
                });
            });

            //fungsi ganti tahun
            $("#gantiTahun").change(function(e) {
                e.preventDefault();
                var form = $("#formGantiTahun")[0];
                var data = new FormData(form);
                $.ajax({
                    method: "POST",
                    url: "<?php echo site_url('auth/gantiTahun') ?>",
                    enctype: "multipart/form-data",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    async: false,
                    success: function(data) {
                        location.reload();
                    },
                    error: function(e) {
                        swal({
                            icon: "error",
                            title: "Gagal!",
                            text: "Oops.. Terjadi kesalahan, silahkan coba lagi.",
                        });
                    },
                });
            });
        });

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "300",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>


    <?php echo $this->renderSection('script'); ?>

</body>

</html>