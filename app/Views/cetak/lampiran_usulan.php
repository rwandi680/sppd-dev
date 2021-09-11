<!DOCTYPE html>
<html lang="en">

<head>
    <title>GeserAPP | Cetak RKA Rincian Belanja</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    <style type="text/css">
        .cetak {
            font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            padding: 0;
            margin: 0;
            font-size: 13px;
        }

        .bawah {
            border-bottom: 1px solid #000;
        }

        .kiri {
            border-left: 1px solid #000;
        }

        .kanan {
            border-right: 1px solid #000;
        }

        .atas {
            border-top: 1px solid #000;
        }

        .text_tengah {
            text-align: center;
        }

        .text_kiri {
            text-align: left;
        }

        .text_kanan {
            text-align: right;
        }

        .text_blok {
            font-weight: bold;
        }

        .text_15 {
            font-size: 15px;
        }

        .text_20 {
            font-size: 20px;
        }

        .footer {
            display: none;
        }

        @media print {
            @page {
                size: auto;
                margin: 11mm 15mm 15mm 15mm;
            }

            body {
                width: 210mm;
                height: 297mm;
            }

            /* .page {
                page-break-after: always;
            }

            .page:last-child {
                page-break-after: avoid;
            } */

            /*.footer { position: fixed; bottom: 0; font-size:11px; display:block; }
        .pagenum:after { counter-increment: page; content: counter(page); }*/
        }
    </style>

</head>

<body>
    <?php

    foreach ($subkeg as $s) { ?>
        <!-- <body onload="window.print()"> -->
        <div class="cetak page">
            <table width="100%" cellpadding="1" cellspacing="2">
                <tr>
                    <td colspan="2">
                        <table width="100%" cellpadding="5" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="atas kanan kiri text_tengah text_15" colspan="13">
                                        <table width="100%" cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td>Rincian Perubahan Anggaran Belanja Kegiatan Satuan Kerja Perangkat Daerah</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="kiri kanan atas" colspan="13">
                                        <table>
                                            <tr>
                                                <td width="150">Urusan Pemerintahan</td>
                                                <td width="10">:</td>
                                                <td><?= $s->nama_urusan  ?></td>
                                            </tr>
                                            <tr>
                                                <td width="150">Bidang Urusan</td>
                                                <td width="10">:</td>
                                                <td><?= $s->nama_bidang_urusan  ?></td>
                                            </tr>
                                            <tr>
                                                <td width="150">Organisasi</td>
                                                <td width="10">:</td>
                                                <td><?= $s->nama_skpd  ?></td>
                                            </tr>
                                            <tr>
                                                <td width="150">Unit</td>
                                                <td width="10">:</td>
                                                <td><?= $s->nama_sub_skpd ?></td>
                                            </tr>
                                            <tr>
                                                <td width="150">Program</td>
                                                <td width="10">:</td>
                                                <td><?= $s->nama_program  ?></td>
                                            </tr>
                                            <tr>
                                                <td width="150">Kegiatan</td>
                                                <td width="10">:</td>
                                                <td><?= $s->nama_giat  ?></td>
                                            </tr>
                                            <tr>
                                                <td width="130">Sub Kegiatan</td>
                                                <td width="10">:</td>
                                                <td><?= $s->nama_sub_giat ?></td>
                                            </tr>
                                            <tr>
                                                <td width="150">Alokasi Tahun <?= $s->tahun ?></td>
                                                <td width="10">:</td>
                                                <td>Rp. <?= format_rupiah($s->pagu, 0, ',', '.') ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kiri kanan atas bawah text_tengah text_blok" rowspan="3">Kode Rekening</td>
                                    <td class="atas kanan bawah text_tengah text_blok" rowspan="3">Uraian</td>
                                    <td class="atas kanan bawah text_tengah text_blok" colspan="5">Sebelum Perubahan</td>
                                    <td class="atas kanan bawah text_tengah text_blok" colspan="5">Setelah Perubahan</td>
                                    <td class="atas kanan bawah text_tengah text_blok" rowspan="3">Bertambah/ (Berkurang)</td>
                                </tr>
                                <tr>
                                    <td class="kanan bawah text_tengah text_blok" colspan="4">Rincian Perhitungan</td>
                                    <td class="kanan bawah text_tengah text_blok" rowspan="2">Jumlah</td>
                                    <td class="kanan bawah text_tengah text_blok" colspan="4">Rincian Perhitungan</td>
                                    <td class="kanan bawah text_tengah text_blok" rowspan="2">Jumlah</td>
                                </tr>
                                <tr>
                                    <td class="kanan bawah text_tengah text_blok">Koefisien</td>
                                    <td class="kanan bawah text_tengah text_blok">Satuan</td>
                                    <td class="kanan bawah text_tengah text_blok">Harga</td>
                                    <td class="kanan bawah text_tengah text_blok">PPN</td>
                                    <td class="kanan bawah text_tengah text_blok">Koefisien</td>
                                    <td class="kanan bawah text_tengah text_blok">Satuan</td>
                                    <td class="kanan bawah text_tengah text_blok">Harga</td>
                                    <td class="kanan bawah text_tengah text_blok">PPN</td>
                                </tr>
                                <?php

                                $tahun = $s->tahun;
                                $kode_skpd = $s->kode_skpd;
                                $kode_urusan = $s->kode_urusan;
                                $kode_bidang_urusan = $s->kode_bidang_urusan;
                                $kode_sub_skpd = $s->kode_sub_skpd;
                                $kode_program = $s->kode_program;
                                $kode_giat = $s->kode_giat;
                                $kode_sub_giat = $s->kode_sub_giat;

                                $db = \Config\Database::connect();


                                //get Rincian Akun
                                $qAkunSubRinci = $db->query(
                                    "SELECT
                                tahun,
                                kode_skpd,
                                kode_urusan,
                                kode_bidang_urusan,
                                kode_sub_skpd,
                                kode_program,
                                kode_giat,
                                kode_sub_giat,
                                kode_akun,
                                nama_akun AS nama_akun,
                                SUM( pagumurni ) AS pagumurni,
                                SUM( pagurubah ) AS pagurubah 
                            FROM
                                (
                                SELECT
                                    murni.tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    akun.kode_akun,
                                    akun.nama_akun,
                                    NULL AS pagurubah,
                                    rincian AS pagumurni 
                                FROM
                                    tbl_bl_rincian_belanja AS murni
                                    LEFT JOIN tbl_ref_akun AS akun ON akun.kode_akun = SUBSTRING( murni.kode_akun, 1, 3 ) 
                                UNION
                                SELECT
                                    usulan.tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    akun.kode_akun,
                                    akun.nama_akun,
                                    rincian AS pagurubah,
                                    NULL AS pagumurni 
                                FROM
                                    tbl_usulan_rincian_belanja AS usulan
                                    LEFT JOIN tbl_ref_akun AS akun ON akun.kode_akun = SUBSTRING( usulan.kode_akun, 1, 3 ) 
                                ) AS a 
                            WHERE
                                tahun = '$tahun' 
                                AND kode_skpd = '$kode_skpd' 
                                AND kode_urusan = '$kode_urusan' 
                                AND kode_bidang_urusan = '$kode_bidang_urusan' 
                                AND kode_sub_skpd = '$kode_sub_skpd' 
                                AND kode_program = '$kode_program' 
                                AND kode_giat = '$kode_giat' 
                                AND kode_sub_giat = '$kode_sub_giat' 
                            GROUP BY
                                kode_akun 
                            UNION ALL
                            SELECT
                                tahun,
                                kode_skpd,
                                kode_urusan,
                                kode_bidang_urusan,
                                kode_sub_skpd,
                                kode_program,
                                kode_giat,
                                kode_sub_giat,
                                kode_akun,
                                nama_akun AS nama_akun,
                                SUM( pagumurni ) AS pagumurni,
                                SUM( pagurubah ) AS pagurubah 
                            FROM
                                (
                                SELECT
                                    murni.tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    akun.kode_akun,
                                    akun.nama_akun,
                                    NULL AS pagurubah,
                                    rincian AS pagumurni 
                                FROM
                                    tbl_bl_rincian_belanja AS murni
                                    LEFT JOIN tbl_ref_akun AS akun ON akun.kode_akun = SUBSTRING( murni.kode_akun, 1, 6 ) 
                                UNION
                                SELECT
                                    usulan.tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    akun.kode_akun,
                                    akun.nama_akun,
                                    rincian AS pagurubah,
                                    NULL AS pagumurni 
                                FROM
                                    tbl_usulan_rincian_belanja AS usulan
                                    LEFT JOIN tbl_ref_akun AS akun ON akun.kode_akun = SUBSTRING( usulan.kode_akun, 1, 6 ) 
                                ) AS a 
                            WHERE
                                tahun = '$tahun' 
                                AND kode_skpd = '$kode_skpd' 
                                AND kode_urusan = '$kode_urusan' 
                                AND kode_bidang_urusan = '$kode_bidang_urusan' 
                                AND kode_sub_skpd = '$kode_sub_skpd' 
                                AND kode_program = '$kode_program' 
                                AND kode_giat = '$kode_giat' 
                                AND kode_sub_giat = '$kode_sub_giat' 
                            GROUP BY
                                kode_akun 
                            UNION ALL
                            SELECT
                                tahun,
                                kode_skpd,
                                kode_urusan,
                                kode_bidang_urusan,
                                kode_sub_skpd,
                                kode_program,
                                kode_giat,
                                kode_sub_giat,
                                kode_akun,
                                nama_akun AS nama_akun,
                                SUM( pagumurni ) AS pagumurni,
                                SUM( pagurubah ) AS pagurubah 
                            FROM
                                (
                                SELECT
                                    murni.tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    akun.kode_akun,
                                    akun.nama_akun,
                                    NULL AS pagurubah,
                                    rincian AS pagumurni 
                                FROM
                                    tbl_bl_rincian_belanja AS murni
                                    LEFT JOIN tbl_ref_akun AS akun ON akun.kode_akun = SUBSTRING( murni.kode_akun, 1, 9 )
                                UNION
                                SELECT
                                    usulan.tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    akun.kode_akun,
                                    akun.nama_akun,
                                    rincian AS pagurubah,
                                    NULL AS pagumurni 
                                FROM
                                    tbl_usulan_rincian_belanja AS usulan
                                    LEFT JOIN tbl_ref_akun AS akun ON akun.kode_akun = SUBSTRING( usulan.kode_akun, 1, 9 ) 
                                ) AS a 
                            WHERE
                                tahun = '$tahun' 
                                AND kode_skpd = '$kode_skpd' 
                                AND kode_urusan = '$kode_urusan' 
                                AND kode_bidang_urusan = '$kode_bidang_urusan' 
                                AND kode_sub_skpd = '$kode_sub_skpd' 
                                AND kode_program = '$kode_program' 
                                AND kode_giat = '$kode_giat' 
                                AND kode_sub_giat = '$kode_sub_giat' 
                            GROUP BY
                                kode_akun
                            UNION ALL
                            SELECT
                                tahun,
                                kode_skpd,
                                kode_urusan,
                                kode_bidang_urusan,
                                kode_sub_skpd,
                                kode_program,
                                kode_giat,
                                kode_sub_giat,
                                kode_akun,
                                nama_akun AS nama_akun,
                                SUM( pagumurni ) AS pagumurni,
                                SUM( pagurubah ) AS pagurubah 
                            FROM
                                (
                                SELECT
                                    murni.tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    akun.kode_akun,
                                    akun.nama_akun,
                                    NULL AS pagurubah,
                                    rincian AS pagumurni 
                                FROM
                                    tbl_bl_rincian_belanja AS murni
                                    LEFT JOIN tbl_ref_akun AS akun ON akun.kode_akun = SUBSTRING( murni.kode_akun, 1, 12 )
                                UNION
                                SELECT
                                    usulan.tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    akun.kode_akun,
                                    akun.nama_akun,
                                    rincian AS pagurubah,
                                    NULL AS pagumurni 
                                FROM
                                    tbl_usulan_rincian_belanja AS usulan
                                    LEFT JOIN tbl_ref_akun AS akun ON akun.kode_akun = SUBSTRING( usulan.kode_akun, 1, 12 ) 
                                ) AS a 
                            WHERE
                                tahun = '$tahun' 
                                AND kode_skpd = '$kode_skpd' 
                                AND kode_urusan = '$kode_urusan' 
                                AND kode_bidang_urusan = '$kode_bidang_urusan' 
                                AND kode_sub_skpd = '$kode_sub_skpd' 
                                AND kode_program = '$kode_program' 
                                AND kode_giat = '$kode_giat' 
                                AND kode_sub_giat = '$kode_sub_giat' 
                            GROUP BY
                                kode_akun
                            UNION ALL
                            SELECT
                                tahun,
                                kode_skpd,
                                kode_urusan,
                                kode_bidang_urusan,
                                kode_sub_skpd,
                                kode_program,
                                kode_giat,
                                kode_sub_giat,
                                kode_akun,
                                nama_akun AS nama_akun,
                                SUM( pagumurni ) AS pagumurni,
                                SUM( pagurubah ) AS pagurubah 
                            FROM
                                (
                                SELECT
                                    murni.tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    akun.kode_akun,
                                    akun.nama_akun,
                                    NULL AS pagurubah,
                                    rincian AS pagumurni 
                                FROM
                                    tbl_bl_rincian_belanja AS murni
                                    LEFT JOIN tbl_ref_akun AS akun ON akun.kode_akun = murni.kode_akun 
                                UNION
                                SELECT
                                    usulan.tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    akun.kode_akun,
                                    akun.nama_akun,
                                    rincian AS pagurubah,
                                    NULL AS pagumurni 
                                FROM
                                    tbl_usulan_rincian_belanja AS usulan
                                    LEFT JOIN tbl_ref_akun AS akun ON akun.kode_akun = usulan.kode_akun 
                                ) AS a 
                            WHERE
                                tahun = '$tahun' 
                                AND kode_skpd = '$kode_skpd' 
                                AND kode_urusan = '$kode_urusan' 
                                AND kode_bidang_urusan = '$kode_bidang_urusan' 
                                AND kode_sub_skpd = '$kode_sub_skpd' 
                                AND kode_program = '$kode_program' 
                                AND kode_giat = '$kode_giat' 
                                AND kode_sub_giat = '$kode_sub_giat' 
                            GROUP BY
                                kode_akun 
                            ORDER BY
                                kode_akun
                                    "
                                );

                                foreach ($qAkunSubRinci->getResult() as $ar) {
                                    // get paket pekerjaan
                                    $qSubTeks = $db->query(
                                        "SELECT
                                    tahun,
                                    kode_skpd,
                                    kode_urusan,
                                    kode_bidang_urusan,
                                    kode_sub_skpd,
                                    kode_program,
                                    kode_giat,
                                    kode_sub_giat,
                                    kode_akun,
                                    slug_subs_bl_teks,
                                    subs_bl_teks,
                                    SUM( pagumurni ) AS pagumurni,
                                    SUM( pagurubah ) AS pagurubah 
                                FROM
                                    (
                                    SELECT
                                        tahun,
                                        kode_skpd,
                                        kode_urusan,
                                        kode_bidang_urusan,
                                        kode_sub_skpd,
                                        kode_program,
                                        kode_giat,
                                        kode_sub_giat,
                                        kode_akun,
                                        slug_subs_bl_teks,
                                        subs_bl_teks,
                                        NULL AS pagurubah,
                                        rincian AS pagumurni 
                                    FROM
                                        tbl_bl_rincian_belanja AS murni
                                    UNION
                                    SELECT
                                        tahun,
                                        kode_skpd,
                                        kode_urusan,
                                        kode_bidang_urusan,
                                        kode_sub_skpd,
                                        kode_program,
                                        kode_giat,
                                        kode_sub_giat,
                                        kode_akun,
                                        slug_subs_bl_teks,
                                        subs_bl_teks,
                                        rincian AS pagurubah,
                                        NULL AS pagumurni 
                                    FROM
                                        tbl_usulan_rincian_belanja AS usulan 
                                    ) AS a 
                                WHERE
                                    tahun = '$tahun' 
                                    AND kode_skpd = '$kode_skpd' 
                                    AND kode_urusan = '$kode_urusan' 
                                    AND kode_bidang_urusan = '$kode_bidang_urusan' 
                                    AND kode_sub_skpd = '$kode_sub_skpd' 
                                    AND kode_program = '$kode_program' 
                                    AND kode_giat = '$kode_giat' 
                                    AND kode_sub_giat = '$kode_sub_giat' 
                                    AND kode_akun = '$ar->kode_akun' 
                                GROUP BY
                                    kode_akun,
                                    slug_subs_bl_teks
                                ORDER BY
                                    slug_subs_bl_teks
                                "
                                    );


                                ?>
                                    <tr>
                                        <td class="kiri kanan bawah text_blok"><?= $ar->kode_akun  ?></td>
                                        <td class="kanan bawah text_blok" colspan="5"><?= $ar->nama_akun ?></td>
                                        <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp. <?= format_rupiah($ar->pagumurni) ?></td>
                                        <td class="kanan bawah text_blok" colspan="4"></td>
                                        <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp. <?= format_rupiah($ar->pagurubah) ?></td>
                                        <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp.
                                            <?php $selisihAkun = $ar->pagurubah - $ar->pagumurni;
                                            echo ($selisihAkun < 0 ? "(" . format_rupiah(abs($selisihAkun)) . ")" : format_rupiah($selisihAkun));
                                            ?>
                                        </td>
                                    </tr>

                                    <?php
                                    foreach ($qSubTeks->getResult() as $sub) {

                                        $qKetTeks = $db->query(
                                            "SELECT
                                        tahun,
                                        kode_skpd,
                                        kode_urusan,
                                        kode_bidang_urusan,
                                        kode_sub_skpd,
                                        kode_program,
                                        kode_giat,
                                        kode_sub_giat,
                                        kode_akun,
                                        slug_subs_bl_teks,
                                        subs_bl_teks,
                                        slug_ket_bl_teks,
                                        ket_bl_teks,
                                        SUM( pagumurni ) AS pagumurni,
                                        SUM( pagurubah ) AS pagurubah 
                                    FROM
                                        (
                                        SELECT
                                            tahun,
                                            kode_skpd,
                                            kode_urusan,
                                            kode_bidang_urusan,
                                            kode_sub_skpd,
                                            kode_program,
                                            kode_giat,
                                            kode_sub_giat,
                                            kode_akun,
                                            slug_subs_bl_teks,
                                            slug_ket_bl_teks,
                                            subs_bl_teks,
                                            ket_bl_teks,
                                            NULL AS pagurubah,
                                            rincian AS pagumurni 
                                        FROM
                                            tbl_bl_rincian_belanja AS murni UNION
                                        SELECT
                                            tahun,
                                            kode_skpd,
                                            kode_urusan,
                                            kode_bidang_urusan,
                                            kode_sub_skpd,
                                            kode_program,
                                            kode_giat,
                                            kode_sub_giat,
                                            kode_akun,
                                            slug_subs_bl_teks,
                                            subs_bl_teks,
                                            slug_ket_bl_teks,
                                            ket_bl_teks,
                                            rincian AS pagurubah,
                                            NULL AS pagumurni 
                                        FROM
                                            tbl_usulan_rincian_belanja AS usulan 
                                        ) AS a 
                                    WHERE
                                        tahun = '$tahun' 
                                        AND kode_skpd = '$kode_skpd' 
                                        AND kode_urusan = '$kode_urusan' 
                                        AND kode_bidang_urusan = '$kode_bidang_urusan' 
                                        AND kode_sub_skpd = '$kode_sub_skpd' 
                                        AND kode_program = '$kode_program' 
                                        AND kode_giat = '$kode_giat' 
                                        AND kode_sub_giat = '$kode_sub_giat' 
                                        AND kode_akun = '$sub->kode_akun' 
                                        AND slug_subs_bl_teks = '$sub->slug_subs_bl_teks' 
                                    GROUP BY
                                    ket_bl_teks
                                            "
                                        );
                                    ?>

                                        <tr>
                                            <td class="kiri kanan bawah text_blok">&nbsp;</td>
                                            <td class="kanan bawah text_blok" colspan="5">[#] <?= $sub->subs_bl_teks ?></td>
                                            <td class="kanan bawah text_kanan text_blok" style="white-space:nowrap"><?= format_rupiah($sub->pagumurni) ?></td>

                                            <td class="kanan bawah text_blok" colspan="4"></td>
                                            <td class="kanan bawah text_kanan text_blok" style="white-space:nowrap"><?= format_rupiah($sub->pagurubah) ?></td>
                                            <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">
                                                <?php $selisihSub = $sub->pagurubah - $sub->pagumurni;
                                                echo ($selisihSub < 0 ? "(" . format_rupiah(abs($selisihSub)) . ")" : format_rupiah($selisihSub));
                                                ?>

                                            </td>

                                        </tr>

                                        <?php
                                        foreach ($qKetTeks->getResult() as $ket) {

                                            // Sript Daftar RIncian Komponen
                                            $qKomponen = $db->query(
                                                "WITH total AS ( 
                                                SELECT kode_akun, slug_subs_bl_teks, subs_bl_teks, slug_ket_bl_teks, ket_bl_teks,no_rincian, nama_komponen, spek_komponen, satuan FROM tbl_bl_rincian_belanja
                                                WHERE
                                                tahun = '$ket->tahun' 
                                                AND kode_skpd = '$ket->kode_skpd' 
                                                AND kode_urusan = '$ket->kode_urusan' 
                                                AND kode_bidang_urusan = '$ket->kode_bidang_urusan' 
                                                AND kode_sub_skpd = '$ket->kode_sub_skpd' 
                                                AND kode_program = '$ket->kode_program' 
                                                AND kode_giat = '$ket->kode_giat' 
                                                AND kode_sub_giat = '$ket->kode_sub_giat'
                                                AND kode_akun = '$ket->kode_akun'
                                                AND slug_subs_bl_teks = '$ket->slug_subs_bl_teks'
                                                AND slug_ket_bl_teks = '$ket->slug_ket_bl_teks'

                                                UNION ALL 
                                                SELECT kode_akun, slug_subs_bl_teks, subs_bl_teks, slug_ket_bl_teks, ket_bl_teks, no_rincian, nama_komponen, spek_komponen, satuan FROM tbl_usulan_rincian_belanja
                                                WHERE
                                                tahun = '$ket->tahun' 
                                                AND kode_skpd = '$ket->kode_skpd' 
                                                AND kode_urusan = '$ket->kode_urusan' 
                                                AND kode_bidang_urusan = '$ket->kode_bidang_urusan' 
                                                AND kode_sub_skpd = '$ket->kode_sub_skpd' 
                                                AND kode_program = '$ket->kode_program' 
                                                AND kode_giat = '$ket->kode_giat' 
                                                AND kode_sub_giat = '$ket->kode_sub_giat'
                                                AND kode_akun = '$ket->kode_akun'
                                                AND slug_subs_bl_teks = '$ket->slug_subs_bl_teks'
                                                AND slug_ket_bl_teks = '$ket->slug_ket_bl_teks'
                                                
                                            )SELECT
                                            kode_akun, tbl_ref_akun.nama_akun AS nama_akun, slug_subs_bl_teks, tbl_usulan_rincian_belanja.subs_bl_teks, slug_ket_bl_teks, tbl_usulan_rincian_belanja.ket_bl_teks, no_rincian,
                                            COALESCE ( tbl_bl_rincian_belanja.nama_komponen, tbl_usulan_rincian_belanja.nama_komponen ) nama_komponen ,
                                            COALESCE ( tbl_bl_rincian_belanja.spek_komponen, tbl_usulan_rincian_belanja.spek_komponen ) spek_komponen_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.satuan, '' ) satuan_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.harga_satuan, 0 ) harga_satuan_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.pajak, 0 ) pajak_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.vol_1, 0 ) vol_1_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.sat_1, '' ) sat_1_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.vol_2, 0 ) vol_2_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.sat_2, '' ) sat_2_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.vol_3, 0 ) vol_3_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.sat_3, '' ) sat_3_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.vol_4, 0 ) vol_4_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.sat_4, '' ) sat_4_murni,
                                            COALESCE ( tbl_bl_rincian_belanja.rincian, 0 ) pagu_murni,
                                            tbl_usulan_rincian_belanja.id_usulan_rincian_belanja,
                                            COALESCE ( tbl_usulan_rincian_belanja.spek_komponen, '' ) spek_komponen,
                                            COALESCE ( tbl_usulan_rincian_belanja.satuan, '' ) satuan_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.harga_satuan, 0 ) harga_satuan_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.pajak, 0 ) pajak_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.vol_1, 0 ) vol_1_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.sat_1, '' ) sat_1_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.vol_2, 0 ) vol_2_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.sat_2, '' ) sat_2_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.vol_3, 0 ) vol_3_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.sat_3, '' ) sat_3_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.vol_4, 0 ) vol_4_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.sat_4, '' ) sat_4_rubah,
                                            COALESCE ( tbl_usulan_rincian_belanja.rincian, 0 ) pagu_rubah 
                                            FROM
                                                total
                                                JOIN tbl_ref_akun USING (kode_akun)
                                                LEFT JOIN tbl_bl_rincian_belanja USING ( kode_akun,slug_subs_bl_teks, slug_ket_bl_teks, no_rincian )
                                                LEFT JOIN tbl_usulan_rincian_belanja USING ( kode_akun,slug_subs_bl_teks, slug_ket_bl_teks,no_rincian ) 
                                            GROUP BY 
                                            kode_akun,
                                            slug_subs_bl_teks,
                                            slug_ket_bl_teks,
                                            no_rincian
                                         "

                                            );



                                        ?>
                                            <tr>
                                                <td class="kiri kanan bawah text_blok">&nbsp;</td>
                                                <td class="kanan bawah text_blok" colspan="5">[-] <?= $ket->ket_bl_teks ?></td>
                                                <td class="kanan bawah text_blok">&nbsp;</td>
                                                <td class="kanan bawah text_blok" colspan="4"></td>
                                                <td class="kanan bawah text_blok">&nbsp;</td>
                                                <td class="kanan bawah text_blok text_kanan">&nbsp;</td>

                                            </tr>
                                            <?php
                                            foreach ($qKomponen->getResult() as $rinci) {

                                                $vol1Murni = $rinci->vol_1_murni;
                                                $vol2Murni = $rinci->vol_2_murni;
                                                $vol3Murni = $rinci->vol_3_murni;
                                                $vol4Murni = $rinci->vol_4_murni;

                                                if (!empty($vol4Murni) || $vol4Murni != 0) {
                                                    $koefisienMurni = "$vol1Murni $rinci->sat_1_murni x $vol2Murni $rinci->sat_2_murni x $vol3Murni $rinci->sat_3_murni x $vol4Murni $rinci->sat_4_murni";
                                                } elseif (!empty($vol3Murni) || $vol3Murni != 0) {
                                                    $koefisienMurni = "$vol1Murni $rinci->sat_1_murni x $vol2Murni $rinci->sat_2_murni x $vol3Murni $rinci->sat_3_murni";
                                                } elseif (!empty($vol2Murni) || $vol2Murni != 0) {
                                                    $koefisienMurni = "$vol1Murni $rinci->sat_1_murni x $vol2Murni $rinci->sat_2_murni";
                                                } else {
                                                    $koefisienMurni = "$vol1Murni $rinci->sat_1_murni";
                                                }

                                                $vol1Rubah = $rinci->vol_1_rubah;
                                                $vol2Rubah = $rinci->vol_2_rubah;
                                                $vol3Rubah = $rinci->vol_3_rubah;
                                                $vol4Rubah = $rinci->vol_4_rubah;

                                                if (!empty($vol4Rubah) || $vol4Rubah != 0) {
                                                    $koefisienRubah = "$vol1Rubah $rinci->sat_1_rubah x $vol2Rubah $rinci->sat_2_rubah x $vol3Rubah $rinci->sat_3_rubah x $vol4Rubah $rinci->sat_4_rubah";
                                                } elseif (!empty($vol3Rubah) || $vol3Rubah != 0) {
                                                    $koefisienRubah = "$vol1Rubah $rinci->sat_1_rubah x $vol2Rubah $rinci->sat_2_rubah x $vol3Rubah $rinci->sat_3_rubah";
                                                } elseif (!empty($vol2Rubah) || $vol2Rubah != 0) {
                                                    $koefisienRubah = "$vol1Rubah $rinci->sat_1_rubah x $vol2Rubah $rinci->sat_2_rubah";
                                                } else {
                                                    $koefisienRubah = "$vol1Rubah $rinci->sat_1_rubah";
                                                }
                                            ?>
                                                <tr>
                                                    <td class="kiri kanan bawah text_blok">&nbsp;</td>
                                                    <td class="kanan bawah">
                                                        <div><?= $rinci->nama_komponen ?></div>
                                                        <div style="margin-left: 20px"> Spesifikasi :
                                                            <?= $rinci->spek_komponen_murni ?>
                                                        </div>
                                                    </td>
                                                    <td class="kanan bawah" style="vertical-align: middle;"><?= $koefisienMurni ?></td>
                                                    <td class="kanan bawah" style="vertical-align: middle;"><?= $rinci->satuan_murni ?></td>
                                                    <td class="kanan bawah text_kanan" style="vertical-align: middle;"><?= format_rupiah($rinci->harga_satuan_murni) ?></td>
                                                    <td class="kanan bawah text_kanan" style="vertical-align: middle;"> <?= format_rupiah($rinci->pajak_murni) ?></td>
                                                    <td class="kanan bawah text_kanan" style="vertical-align: middle;white-space:nowrap"><?= format_rupiah($rinci->pagu_murni) ?></td>

                                                    <td class="kanan bawah" style="vertical-align: middle;"><?= $koefisienRubah ?></td>
                                                    <td class="kanan bawah" style="vertical-align: middle;"><?= $rinci->satuan_rubah ?></td>
                                                    <td class="kanan bawah text_kanan" style="vertical-align: middle;">
                                                        <?= format_rupiah($rinci->harga_satuan_rubah) ?>
                                                    </td>
                                                    <td class="kanan bawah text_kanan" style="vertical-align: middle;"><?= format_rupiah(0) ?></td>
                                                    <td class="kanan bawah text_kanan" style="vertical-align: middle;white-space:nowrap"><?= format_rupiah($rinci->pagu_rubah) ?></td>
                                                    <td class="kanan bawah text_kanan" style="white-space:nowrap">
                                                        <?php
                                                        $selisihRincian = $rinci->pagu_rubah - $rinci->pagu_murni;
                                                        echo ($selisihRincian < 0 ? "(" . format_rupiah(abs($selisihRincian)) . ")" : format_rupiah($selisihRincian));
                                                        ?>

                                                    </td>
                                                </tr>

                                <?php
                                            } //end foreach komponen
                                        } // end foreach kettest
                                    } //end foreach subteks
                                }
                                //end foreach Akun

                                $getPaguSebelum = $db->query("SELECT SUM(rincian) AS sebelum
                                FROM tbl_bl_rincian_belanja
                                WHERE
                                    tahun = '$tahun' 
                                    AND kode_skpd = '$kode_skpd' 
                                    AND kode_urusan = '$kode_urusan' 
                                    AND kode_bidang_urusan = '$kode_bidang_urusan' 
                                    AND kode_sub_skpd = '$kode_sub_skpd' 
                                    AND kode_program = '$kode_program' 
                                    AND kode_giat = '$kode_giat' 
                                    AND kode_sub_giat = '$kode_sub_giat'
                                 ");
                                $sblm = $getPaguSebelum->getRow();

                                $getPaguSesudah = $db->query("SELECT SUM(rincian) AS sesudah
                                FROM tbl_usulan_rincian_belanja
                                WHERE
                                    tahun = '$tahun' 
                                    AND kode_skpd = '$kode_skpd' 
                                    AND kode_urusan = '$kode_urusan' 
                                    AND kode_bidang_urusan = '$kode_bidang_urusan' 
                                    AND kode_sub_skpd = '$kode_sub_skpd' 
                                    AND kode_program = '$kode_program' 
                                    AND kode_giat = '$kode_giat' 
                                    AND kode_sub_giat = '$kode_sub_giat'
                                 ");
                                $sesudah = $getPaguSesudah->getRow();


                                ?>




                                <tr>
                                    <td colspan="6" class="kiri kanan bawah text_kanan text_blok">Jumlah Anggaran Sub Kegiatan :</td>
                                    <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp. <?= format_rupiah($sblm->sebelum)  ?></td>
                                    <td colspan="4" class="kanan bawah text_kanan text_blok">Jumlah Anggaran Sub Kegiatan :</td>
                                    <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp. <?= format_rupiah($sesudah->sesudah) ?></td>
                                    <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp.
                                        (2.970.200.000)
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                    </td>
                </tr>
            </table>

        <?php } ?>
        <!-- Endi Foreach subkeg -->
        </div>
        <div class="cetak">
            <table width="100%" cellpadding="1" cellspacing="2">
                <tr>
                    <td class="kiri kanan atas bawah" width="50%" valign="top">
                        &nbsp;
                    </td>
                    <td class="kiri kanan atas bawah" width="50%" valign="top">
                        <table width="100%" cellpadding="2" cellspacing="0">
                            <tr>
                                <td colspan="3" class="text_tengah">Kabupaten Pangandaran, <?= date_indo($usulan->tgl_surat_usulan) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text_tengah text_15">Kepala&nbsp;<?php echo ucwords(strtolower($skpd->nama_skpd))  ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" height="80">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text_tengah">
                                    <?php if (isset($kadis->nama_kepala)) {
                                        echo $kadis->nama_kepala;
                                    } else {
                                        echo "-";
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text_tengah">NIP.
                                    <?php if (isset($kadis->nip)) {
                                        echo $kadis->nip;
                                    } else {
                                        echo "-";
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="100%" cellpadding="5" cellspacing="0">
                            <tr>
                                <td width="160" class="kiri atas bawah">Keterangan</td>
                                <td width="10" class="atas bawah">:</td>
                                <td class="atas bawah kanan">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="160" class="kiri bawah">Tanggal Pembahasan</td>
                                <td width="10" class="bawah">:</td>
                                <td class="bawah kanan">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="160" class="kiri bawah">Catatan Hasil Pembahasan</td>
                                <td width="10" class="bawah">:</td>
                                <td class="bawah kanan">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="kiri bawah kanan" colspan="3">1.&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="kiri bawah kanan" colspan="3">2.&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="kiri bawah kanan" colspan="3">3.&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="kiri bawah kanan" colspan="3">4.&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="kiri bawah kanan" colspan="3">5.&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </div>

</body>

</html>