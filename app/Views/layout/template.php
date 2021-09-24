<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>SPPD MAster | <?= $title ?></title>

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
                        <span class="brand-name">SPPD</span>
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-scrollbar">

                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">

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
                        &copy; <span id="copy-year">2019</span> | SPPD Master
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