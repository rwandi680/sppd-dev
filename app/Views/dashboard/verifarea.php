<?php
echo $this->extend('layout/template');

echo $this->section('content');
?>
<div class="row">
    <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="card card-table-border-none" id="recent-orders">
            <div class="card-header justify-content-between">
                <h2>Usulan Terbaru</h2>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-responsive-large" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SKPD</th>
                            <th>Uraian</th>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;
                        foreach ($usulan as $u) {
                            $sts = $u->sts_usulan;
                        ?>
                            <tr>
                                <td><?= $n++ ?></td>
                                <td><?= $u->nama_skpd ?></td>
                                <td><?= $u->uraian_usulan ?></td>
                                <td><?= $u->no_surat_usulan ?></td>
                                <td><?= date_indo($u->tgl_surat_usulan)  ?></td>
                                <td><?= $stsUsulan[$sts]  ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

echo $this->endSection('content');

echo $this->section('script');
echo $this->endSection('script');
?>