<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <?php $this->load->view('style.css'); ?>
    </style>
</head>

<body>

    <table style="width:100%">
        <tr>
            <th colspan="6">Kode</th>
            <th>Uraian</th>
            <th>RPJMD</th>
            <th>Rancangan APBD</th>
        </tr>
        <?php
        //skpd
        $qskpd = $this->db->query("SELECT skpd, SUM(pagu) AS paguskpd FROM tbl_lamp2 GROUP BY skpd");
        foreach ($qskpd->result() as $skpd) {

            echo
                '<tr>
                    <td><strong>' . substr($skpd->skpd, 0, 20) . '</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>' . substr($skpd->skpd, 20) . '</strong></td>
                    <td></td>
                    <td class="kanan"><strong>' . number_format($skpd->paguskpd, 0, ',', '.') . '</strong></td>
                </tr>';
            ///urusan
            $qurusan = $this->db->query("SELECT urusan, SUM(pagu) AS paguurusan FROM tbl_lamp2 WHERE skpd='$skpd->skpd' GROUP BY urusan");
            foreach ($qurusan->result() as $u) {

                echo
                    '<tr>
                        <td><strong>' . substr($skpd->skpd, 0, 20) . '</td>
                        <td><strong>' . substr($u->urusan, 0, 1) . '</strong></>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>' . substr($u->urusan, 1) . '</strong></td>
                        <td></td>
                        <td class="kanan"><strong>' . number_format($u->paguurusan, 0, ',', '.') . '</strong></td>
                    </tr>';

                //sub urusan
                $qsuburusan = $this->db->query("SELECT sub_urusan, SUM(pagu) AS pagusuburus FROM tbl_lamp2 WHERE skpd = '$skpd->skpd' AND urusan = '$u->urusan' GROUP BY sub_urusan");
                foreach ($qsuburusan->result() as $sub) {
                    $namelength = strlen($sub->sub_urusan);
                    if ($namelength > 32) {
                        $suburusan = substr($sub->sub_urusan, 32);
                    } else {
                        $suburusan = substr($sub->sub_urusan, 4);
                    }


                    echo
                        '<tr>
                            <td><strong>' . substr($skpd->skpd, 0, 20) . '</td>
                            <td><strong>' . substr($u->urusan, 0, 1) . '</strong></td>
                            <td><strong>' . substr($sub->sub_urusan, 2, 2) . '</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>' . $suburusan . '</strong></td>
                            <td></td>
                            <td class="kanan"><strong>' . number_format($sub->pagusuburus, 0, ',', '.') . '</strong></td>
                        </tr>';



                    //program
                    $qprog = $this->db->query("SELECT sub_urusan, skpd, program, SUM(pagu) AS paguprog FROM tbl_lamp2 WHERE skpd = '$skpd->skpd' AND urusan = '$u->urusan' AND sub_urusan = '$sub->sub_urusan' GROUP BY program");
                    $sum = 0;
                    foreach ($qprog->result() as $prog) {

                        echo
                            '<tr>
                                <td><strong>' . substr($skpd->skpd, 0, 20) . '</strong></td>
                                <td><strong>' . substr($u->urusan, 0, 1) . '</strong></td>
                                <td><strong>' . substr($sub->sub_urusan, 2, 2) . '</strong></td>
                                <td><strong>' . substr($prog->program, 0, 7) . '</strong></td>
                                <td></td>
                                <td></td>
                                <td><strong>' . substr($prog->program, 7) . '</strong></td>
                                <td></td>
                                <td class="kanan"><strong>' . number_format($prog->paguprog, 0, ',', '.') . '</strong></td>
                            </tr>';

                        //kegiatan
                        $qkeg = $this->db->query("SELECT sub_urusan, skpd, program, kegiatan, SUM(pagu) AS pagukeg FROM tbl_lamp2 WHERE skpd = '$prog->skpd' AND urusan = '$u->urusan' AND sub_urusan = '$prog->sub_urusan' AND program = '$prog->program' GROUP BY kegiatan");
                        foreach ($qkeg->result() as $keg) {

                            echo
                                '<tr>
                                    <td>' . substr($skpd->skpd, 0, 20) . '</td>
                                    <td>' . substr($u->urusan, 0, 1) . '</td>
                                    <td>' . substr($sub->sub_urusan, 2, 2) . '</td>
                                    <td>' . substr($prog->program, 0, 7) . '</td>
                                    <td>' . substr($keg->kegiatan, 0, 12) . '</td>
                                    <td></td>
                                    <td><strong>' . substr($keg->kegiatan, 12) . '</strong></td>
                                    <td></td>
                                    <td class="kanan">' . number_format($keg->pagukeg, 0, ',', '.') . '</strong></td>
                                </tr>';

                            //sub kegiatan
                            $qsubkeg = $this->db->query("SELECT sub_kegiatan, SUM(pagu) AS pagusubkeg FROM tbl_lamp2 WHERE skpd = '$keg->skpd' AND urusan = '$u->urusan' AND sub_urusan = '$keg->sub_urusan' AND program = '$keg->program' AND kegiatan='$keg->kegiatan' GROUP BY sub_kegiatan");
                            foreach ($qsubkeg->result() as $skeg) {

                                echo
                                    '<tr>
                                        <td>' . substr($skpd->skpd, 0, 20) . '</td>
                                        <td>' . substr($u->urusan, 0, 1) . '</td>
                                        <td>' . substr($sub->sub_urusan, 2, 2) . '</td>
                                        <td>' . substr($prog->program, 0, 7) . '</td>
                                        <td>' . substr($keg->kegiatan, 0, 12) . '</td>
                                        <td>' . substr($skeg->sub_kegiatan, 0, 15) . '</td>
                                        <td>' . substr($skeg->sub_kegiatan, 15) . '</td>
                                        <td></td>
                                        <td class="kanan">' . number_format($skeg->pagusubkeg, 0, ',', '.') . '</strong></td>
                                    </tr>';
                            }
                        }
                    }
                }
            }
        }
        ?>
    </table>

</body>

</html>