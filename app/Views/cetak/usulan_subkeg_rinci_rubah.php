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

            /*.footer { position: fixed; bottom: 0; font-size:11px; display:block; }
        .pagenum:after { counter-increment: page; content: counter(page); }*/
        }
    </style>

</head>

<body>
    <!-- <body onload="window.print()"> -->
    <div class="cetak">
        <table width="100%" cellpadding="1" cellspacing="2">
            <tr>
                <td colspan="2">
                    <table width="100%" cellpadding="5" cellspacing="1" class="text_tengah text_15">
                        <tr>
                            <td class="kiri atas kanan bawah text_blok">RENCANA KERJA DAN PERUBAHAN ANGGARAN<br />SATUAN KERJA PERANGKAT DAERAH</td>
                            <td class="kiri atas kanan bawah text_blok" rowspan="2">Formulir<br />RKPA - RINCIAN BELANJA SKPD</td>
                        </tr>
                        <tr>
                            <td class="kiri atas kanan bawah">Pemerintah Kabupaten Pangandaran Tahun Anggaran <?= $subKeg->tahun ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" cellpadding="2" cellspacing="1">
                        <tr>
                            <td width="150">Urusan Pemerintahan</td>
                            <td width="10">:</td>
                            <td><?= $refUrusan  ?></td>
                        </tr>
                        <tr>
                            <td width="150">Bidang Urusan</td>
                            <td width="10">:</td>
                            <td><?= $refBidang  ?></td>
                        </tr>
                        <tr>
                            <td width="150">Organisasi</td>
                            <td width="10">:</td>
                            <td><?= $profil->kode_skpd . ' ' . $profil->nama_skpd  ?></td>
                        </tr>
                        <tr>
                            <td width="150">Unit</td>
                            <td width="10">:</td>
                            <td><?= $subUnit->kode_skpd . ' ' . $subUnit->nama_skpd  ?></td>
                        </tr>
                        <tr>
                            <td width="150">Program</td>
                            <td width="10">:</td>
                            <td><?= $refProgram  ?></td>
                        </tr>
                        <tr>
                            <td width="150">Kegiatan</td>
                            <td width="10">:</td>
                            <td><?= $refKegiatan  ?></td>
                        </tr>
                        <tr>
                            <td width="150">Sub Kegiatan</td>
                            <td width="10">:</td>
                            <td><?= $refSubKeg ?></td>
                        </tr>
                        <tr>
                            <td width="150">Pagu Rincian</td>
                            <td width="10">:</td>
                            <td>Rp. <?= format_rupiah($pagu->pagu_rincian) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="150" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="atas kanan bawah kiri text_tengah text_15" colspan="2">
                    <table width="100%" cellpadding="5" cellspacing="0">
                        <tr>
                            <td>Rincian Perubahan Anggaran Belanja Kegiatan Satuan Kerja Perangkat Daerah</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" cellpadding="5" cellspacing="0">
                        <tbody>
                            <tr>
                                <td class="kiri atas kanan bawah text_tengah text_blok" rowspan="3">Kode Rekening</td>
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

                            $thn = $subKeg->tahun;
                            $idSkpd = $subKeg->id_skpd;
                            $idUsulan = $subKeg->id_usulan;
                            $idSubUnit = $subKeg->id_sub_unit;
                            $idSubKeg = $subKeg->id_usulan_sub_kegiatan;
                            $idRefSubKeg = $subKeg->id_sub_kegiatan;

                            $db = \Config\Database::connect();


                            //get Rincian Akun
                            foreach ($akun as $a) {
                                $tingkat = $a->tingkat;
                                $kdAkun = '';
                                $nmAkun = $a->nama_akun;
                                if ($tingkat == 1) {
                                    $kdAkun = $a->kode_akun_1;
                                } elseif ($tingkat == 2) {
                                    $kdAkun = $a->kode_akun_2;
                                } elseif ($tingkat == 3) {
                                    $kdAkun = $a->kode_akun_3;
                                } elseif ($tingkat == 4) {
                                    $kdAkun = $a->kode_akun_4;
                                } elseif ($tingkat == 5) {
                                    $kdAkun = $a->kode_akun_5;
                                }

                                $selisihAkun = $a->pagu_rubah - $a->pagu_murni;


                            ?>
                                <tr>
                                    <td class="kiri kanan bawah text_blok"><?= $kdAkun ?></td>
                                    <td class="kanan bawah text_blok" colspan="5"><?= $nmAkun ?></td>
                                    <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp. <?= format_rupiah($a->pagu_murni) ?> </td>
                                    <td class="kanan bawah text_blok" colspan="4"></td>
                                    <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp. <?= format_rupiah($a->pagu_rubah) ?> </td>
                                    <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp. <?= format_rupiah($selisihAkun) ?>

                                    </td>
                                </tr>

                                <?php
                                if ($tingkat == 5) {

                                    $qPaket = $db->query(
                                        "SELECT
                                    kode_akun_5,
                                    paket_bl_slug,
                                    paket_bl,
                                    SUM( pagu_murni ) AS pagu_murni,
                                    SUM( pagu_rubah ) AS pagu_rubah 
                                FROM
                                    (
                                    SELECT
                                        a1.kode_akun AS kode_akun_5,
                                        m.nama_paket_bl_slug AS paket_bl_slug,
                                        m.nama_paket_bl AS paket_bl,
                                        SUM( m.nominal_rincian ) AS pagu_murni,
                                        0 AS pagu_rubah 
                                    FROM
                                        tbl_rincian_belanja_murni AS m
                                        LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = m.id_ref_akun 
                                    WHERE
                                        m.tahun = $thn 
                                        AND m.id_skpd = $idSkpd 
                                        AND m.id_sub_unit = $idSubUnit
                                        AND m.id_sub_kegiatan = $idRefSubKeg 
                                        AND a1.kode_akun = '$a->kode_akun_5' 
                                    
                                    UNION ALL
                                    SELECT
                                        a1.kode_akun AS kode_akun_5,
                                        r.nama_paket_bl_slug AS paket_bl_slug,
                                        r.nama_paket_bl AS paket_bl,
                                        0 AS pagu_murni,
                                        SUM( r.nominal_rincian ) AS pagu_rubah 
                                    FROM
                                        tbl_usulan_rincian_belanja AS r
                                        LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun 
                                    WHERE
                                        r.tahun = $thn 
                                        AND r.id_usulan = $idUsulan 
                                        AND r.id_skpd = $idSkpd 
                                        AND r.id_sub_unit = $idSubUnit 
                                        AND r.id_usulan_sub_kegiatan = $idSubKeg 
                                        AND a1.kode_akun = '$a->kode_akun_5' 
                                    
                                    ) AS a
                                        "
                                    );

                                    foreach ($qPaket->getResult() as $p) {
                                        $selisihPaket = $p->pagu_rubah - $p->pagu_murni;
                                ?>
                                        <tr>
                                            <td class="kiri kanan bawah text_blok">&nbsp;</td>
                                            <td class="kanan bawah text_blok" colspan="5">[#] <?= $p->paket_bl ?></td>
                                            <td class="kanan bawah text_kanan text_blok" style="white-space:nowrap">Rp. <?= format_rupiah($p->pagu_murni) ?></td>

                                            <td class="kanan bawah text_blok" colspan="4"></td>
                                            <td class="kanan bawah text_kanan text_blok" style="white-space:nowrap">Rp. <?= format_rupiah($p->pagu_rubah) ?> </td>
                                            <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp. <?= format_rupiah($selisihPaket) ?>
                                            </td>
                                        </tr>
                            <?php

                                    } //end foreach paket
                                } // end if tingkat
                            } // end forech akun
                            ?>



                            <tr>
                                <td class="kiri kanan bawah text_blok">&nbsp;</td>
                                <td class="kanan bawah text_blok" colspan="5">[-] </td>
                                <td class="kanan bawah text_blok">&nbsp;</td>
                                <td class="kanan bawah text_blok" colspan="4"></td>
                                <td class="kanan bawah text_blok">&nbsp;</td>
                                <td class="kanan bawah text_blok text_kanan">&nbsp;</td>

                            </tr>

                            <tr>
                                <td class="kiri kanan bawah text_blok">&nbsp;</td>
                                <td class="kanan bawah">
                                    <div></div>
                                    <div style="margin-left: 20px"> Spesifikasi :

                                    </div>
                                </td>
                                <td class="kanan bawah" style="vertical-align: middle;"> </td>
                                <td class="kanan bawah" style="vertical-align: middle;"> </td>
                                <td class="kanan bawah text_kanan" style="vertical-align: middle;"> </td>
                                <td class="kanan bawah text_kanan" style="vertical-align: middle;"> </td>
                                <td class="kanan bawah text_kanan" style="vertical-align: middle;white-space:nowrap"> </td>

                                <td class="kanan bawah" style="vertical-align: middle;"> </td>
                                <td class="kanan bawah" style="vertical-align: middle;"> </td>
                                <td class="kanan bawah text_kanan" style="vertical-align: middle;">
                                    f
                                </td>
                                <td class="kanan bawah text_kanan" style="vertical-align: middle;"> </td>
                                <td class="kanan bawah text_kanan" style="vertical-align: middle;white-space:nowrap"> </td>
                                <td class="kanan bawah text_kanan" style="white-space:nowrap">

                                </td>
                            </tr>




                            <tr>
                                <td colspan="6" class="kiri kanan bawah text_kanan text_blok">Jumlah Anggaran Sub Kegiatan :</td>
                                <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp. 11.494.300.000</td>
                                <td colspan="4" class="kanan bawah text_kanan text_blok">Jumlah Anggaran Sub Kegiatan :</td>
                                <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp. 8.524.100.000</td>
                                <td class="kanan bawah text_blok text_kanan" style="white-space:nowrap">Rp.
                                    (2.970.200.000)
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td class="kiri kanan atas bawah" width="350" valign="top">
                    &nbsp;
                </td>
                <td class="kiri kanan atas bawah" width="250" valign="top">
                    <table width="100%" cellpadding="2" cellspacing="0">
                        <tr>
                            <td colspan="3" class="text_tengah"><?= $profil->kota_skpd  . ', ' . date_indo($usulan->tgl_surat_usulan) ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text_tengah text_15">Kepala <?= ucwords(strtolower($profil->nama_skpd))  ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" height="80">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text_tengah text_blok">
                                <u>
                                    <?php if (isset($kadis->nama_kepala)) {
                                        echo $kadis->nama_kepala;
                                    } else {
                                        echo "-";
                                    } ?>
                                </u>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text_tengah">NIP.
                                <?php if (isset($kadis->nip_kepala)) {
                                    echo $kadis->nip_kepala;
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
                            <td width="160" class="kiri atas bawah">Catatan Hasil Pembahasan</td>
                            <td width="10" class="atas bawah">:</td>
                            <td class="atas bawah kanan">&nbsp;</td>
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