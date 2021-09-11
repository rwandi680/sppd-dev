<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GeserAPP | Surat Permohonan Pergeseran Anggaran</title>
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
                <h3 class="nomargin"><?= $skpd->nama_skpd ?></h3>
                <p class="nomargin"><?= $skpd->alamat_skpd ?></p>
            </td>
        </tr>
    </table>
    <hr style="width: 100%; color: black; height: 1px; background-color:black; border:none" class="nomargin" />
    <hr style="width: 100%; color: black; height: 3px; background-color:black; border:none;margin-top:1px" />
    <!-- format Nomor surat -->
    <table style="width:100%;">
        <tr>
            <td style="width:15%"></td>
            <td></td>
            <td style="width:40%">
                <p style="text-indent: 30px" class="nomargin"><?= '&nbsp;' . $skpd->kota_skpd . ', '. date_indo($usulan->tgl_surat_usulan); ?></p>
            </td>
        </tr>
        <tr>
            <td style="width:15%;vertical-align: text-top;">
                Nomor<br>
                Lampiran<br>
                Hal<br>
            </td>
            <td style="vertical-align: text-top;">
                : <?= $usulan->no_surat_usulan ?><br>
                : 1 (Satu) Berkas<br>
                : <?= $usulan->uraian_usulan ?>
            </td>
            <td>
                <p style="text-indent: 30px" class="nomargin">&nbsp;Kepada:
                    <br>Yth.&nbsp;<strong>Ketua TAPD</strong>
                </p>
                <p style="text-indent: 30px" class="nomargin"><strong>&nbsp;Kabupaten Pangandaran</strong></p>
                <p style="text-indent: 30px" class="nomargin">&nbsp; di - </p>
                <p class="nomargin text-center">TEMPAT</p>
            </td>
        </tr>
    </table>
    <br>
    <p style="text-align: justify;margin-left:120px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Dipermaklumkan dengan hormat, dengan ini kami sampaikan permohonan pergeseran anggaran belanja tahun <?= $usulan->tahun ?> untuk Sub Kegiatan Belanja sebagai berikut:
    </p>
    <div id="tableRincian" style="padding-left: 120px;">
        <table class="tbl" style="width:100%;">
            <thead>
                <tr>
                    <th class="br">No.</th>
                    <th class="br">Program, Kegiatan, Sub Kegiatan</th>
                    <th class="br">Pagu Rincian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 1;
                foreach ($subkeg as $s) {
                    if ($s->progumum == 1) {
                        $uraian = $bidang->kode_bidang_urusan . \substr($s->uraian, 4);
                    } elseif ($s->kegumum == 1) {
                        $uraian = $bidang->kode_bidang_urusan . \substr($s->uraian, 4);
                    } elseif ($s->subkegumum == 1) {
                        $uraian = $bidang->kode_bidang_urusan . \substr($s->uraian, 4);
                    } else {
                        $uraian = $s->uraian;
                    }

                    if ($s->level != 3) {
                        $textUraian = "<strong>$uraian</strong>";
                    } else {
                        $textUraian = $uraian;
                    }

                ?>
                    <tr>
                        <td class="br text-center"><?= $n++ ?></td>
                        <td class="br"><?= $textUraian ?></td>
                        <td class="br"></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <p style="text-align: justify;margin-left:120px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Adapun rincian belanja Sub Kegiatan Belanja dimaksud sebagaimana terlampir.
    </p>
    <p style="text-align: justify;margin-left:120px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Demikian kami sampaikan. Atas perhatiannya kami ucapkan terima kasih.
    </p>
    <table style="width:100%">
        <tr>
            <td style="width:50%"></td>
            <td class="text-center">
                <?php
                $jabatan = array(
                    \null => 'Kepala',
                    '' => 'Kepala',
                    1 => 'Kepala',
                    2 => 'Plt. Kepala'
                );
                ?>
                <p class="nomargin"><?= $jabatan[$skpd->jabatan_kepala] . '&nbsp;' . ucwords(strtolower($skpd->nama_skpd)) ?></p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p class="nomargin"><strong><u>
                            <?php if (isset($skpd->nama_kepala)) {
                                echo $skpd->nama_kepala;
                            } else {
                                echo "-";
                            } ?>
                        </u></strong></p>
                <p class="nomargin">
                    NIP. <?php if (isset($skpd->nip_kepala)) {
                                echo $skpd->nip_kepala;
                            } else {
                                echo "-";
                            } ?>
                </p>
            </td>
        </tr>
    </table>
</body>