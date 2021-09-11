<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>GeserAPP | <?= $title ?></title>

    <!-- FAVICON -->
    <link href="<?= site_url() ?>public/assets/img/favicon.png" rel="shortcut icon" />
    <script src="<?= site_url() ?>public/assets/plugins/nprogress/nprogress.js"></script>

    <link href="<?= site_url() ?>public/assets/font/roboto/roboto.css" rel="stylesheet" />

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="<?= site_url() ?>public/assets/css/sleek.css" />

</head>

<body class="bg-light-gray" id="body">
    <div class="container d-flex flex-column justify-content-between vh-100">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="app-brand">
                            <a href="/index.html">
                                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
                                    <g fill="none" fill-rule="evenodd">
                                        <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                    </g>
                                </svg>
                                <span class="brand-name">Geser App</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-5">

                        <h4 class="text-dark mb-5">Sign In</h4>
                        <?= form_open('auth/login', ['id' => 'sign_in', 'method' => 'POST']) ?>
                        <div class="row">
                            <?php
                            $error = session('error');
                            if (isset($error)) {
                                echo '
                                <div class="form-group col-md-12">
                                    <div class="alert alert-danger" role="alert">
										' . $error . '
									</div>
								</div>
                                        ';
                            }

                            ?>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="xuser" id="user" placeholder="Username" required>
                            </div>
                            <div class="form-group col-md-12 ">
                                <input type="password" class="form-control" name="xpass" id="password" placeholder="Password" required>
                            </div>
                            <div class="form-group col-md-12 ">
                                <select name="xthn" id="tahun" class="form-control">
                                    <option value="" disabled>-- Pilih Tahun --</option>
                                    <?php
                                    $thn =  date('Y');
                                    foreach ($tahun as $t) {
                                        $selected = ($t->tahun == $thn) ? ' selected="selected"' : "";

                                        echo '<option value="' . $t->tahun . '" ' . $selected . '>' . $t->tahun . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign In</button>

                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright pl-0">
            <p class="text-center">&copy; 2021 | Sistem Informasi Manajemen Pergeseran Anggaran by
                <a class="text-primary" href="https://bpkd.pangandarankab.go.id/" target="_blank">BPKD Kab. Pangandaran</a>.
            </p>
        </div>
    </div>
</body>

</html>