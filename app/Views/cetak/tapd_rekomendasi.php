<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GeserAPP | Surat Rekomendasi TAPD</title>
    <!-- FAVICON -->
    <link href="<?= site_url() ?>public/assets/img/favicon/favicon.ico" rel="shortcut icon" />

    <style>
        body {
            font-family: 'Arial', Arial, Helvetica, sans-serif !important;
            font-size: 12pt;
        }

        .page {
            overflow: hidden;
            position: relative;
            page-break-after: always;
        }

        .nomargin {
            margin: 0;
        }

        .nomt {
            margin-top: 0;
        }

        .nomb {
            margin-bottom: 0;
        }

        .text-center {
            text-align: center;
        }

        .tbl {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .br {
            border: 1px solid black;
        }
    </style>
</head>

<body>

    <?php
    $logo = img_data('public/assets/img/logo.jpg');
    ?>

    <!-- Kop Surat SKPD -->
    <table style=" width:100%">
        <tr>
            <td width="75px"><?= img($logo, false, 'width = 65px') ?>
            </td>
            <td class="text-center">
                <h3 class="nomargin">PEMERINTAH KABUPATEN PANGANDARAN</h3>
                <h2 class="nomargin">TIM ANGGARAN PEMERINTAH DAERAH</h2>
                <p class="nomargin"><?= $tapd->alamat_tapd ?></p>
            </td>
        </tr>
    </table>
    <hr style="width: 100%; color: black; height: 1px; background-color:black; border:none" class="nomargin" />
    <hr style="width: 100%; color: black; height: 3px; background-color:black; border:none;margin-top:1px" />
    <table style="width:100%;">
        <tr>
            <td style="width:15%"></td>
            <td></td>
            <td style="width:40%">
                <p style="text-indent: 30px" class="nomb"><?php //echo $kecc . ', ' . $tgl_ba; 
                                                            ?></p>
            </td>
        </tr>
        <tr>
            <td style="width:15%"></td>
            <td></td>
            <td style="width:40%">
                <p style="text-indent: 30px" class="nomargin">Kepada:
                    <br>Yth. <strong>BUPATI PANGANDARAN</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <p style="text-indent: 30px" class="nomargin">Melalui:</p>
            </td>
        </tr>
        <tr style="vertical-align: text-top;">
            <td></td>
            <td></td>
            <td>
                <p style="text-indent: 30px" class="nomargin">Kepala DINSOSPMD</p>
                <p style="text-indent: 30px" class="nomargin">Kabupaten Pangandaran</p>
                <p style="text-indent: 30px" class="nomargin"> di - </p>
                <p class="text-center nomargin">TEMPAT</p>
            </td>
        </tr>
    </table>
    <h4 class="text-center nomb"><strong><u>REKOMENDASI</u></strong></h4>
    <p class="text-center nomargin"><?php echo "Nomor : " ?></p>
    <p style="text-indent: 40px">Memperhatikan usulan permohonan pencairan:</p>
    <table style="width:100%;">
        <tr style="vertical-align: text-top;">
            <td style="width:25%;">
                <p style="text-indent: 70px" class="nomargin">Desa</p>
            </td>
            <td>
                <p class="nomargin">: <?php //echo $desa->desa; 
                                        ?></p>
            </td>
        </tr>
        <tr style="vertical-align: text-top;">
            <td>
                <p style="text-indent: 70px" class="nomargin">Nomor</p>
            </td>
            <td>
                <p class="nomargin">: <?php //echo $usulan->no_srt_usulan_add 
                                        ?></p>
            </td>
        </tr>
        <tr style="vertical-align: text-top;">
            <td>
                <p style="text-indent: 70px" class="nomargin">Untuk</p>
            </td>
            <td>
                <p class="nomargin untuk">: <?php //echo "Pencairan Alokasi Dana Desa " . $tahap->tahapan . " Tahun " . $usulan->tahun; 
                                            ?></p>
            </td>
        </tr>
        <tr style="vertical-align: text-top;">
            <td>
                <p style="text-indent: 70px" class="nomargin">Sebesar</p>
            </td>
            <td>
                <p class="nomargin untuk">: <?php //echo "Rp." . number_format($usulan->nominal, 0, ',', '.') . " (" . ucwords(number_to_words($usulan->nominal)) . " Rupiah)"; 
                                            ?></p>
            </td>
        </tr>
    </table>
    <p style="text-align:justify;line-height:1.5;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Dengan ini kami memberikan rekomendasi terhadap proses pencairan dana tersebut dari Pemerintah Kabupaten Pangandaran kepada rekening Kas Desa yang bersangkutan.
    </p>
    <p style="text-align:justify;line-height:1.5;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Demikian kami sampaikan. Atas perhatiannya kami ucapkan terima kasih.
    </p>

    <br>
    <table style="width:100%">
        <tr>
            <td style="width:50%"></td>
            <td class="text-center">
                <p class="nomargin">CAMAT <?php //echo $kec->kecamatan 
                                            ?></p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p class="nomargin"><strong><u><?php //echo $camat->nama_camat 
                                                ?></u></strong></p>
                <p class="nomargin">NIP. <?php //echo $camat->nip_camat 
                                            ?></p>
            </td>
        </tr>
    </table>

</body>

</html>