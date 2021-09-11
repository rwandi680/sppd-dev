<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row clearfix">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body table-responsive-md">
                <table class="table table-hover table-striped" id="tabelData" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Urusan</th>
                            <th>Kode Bidang</th>
                            <th>Nama Bidang</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

echo $this->endSection('content');

echo $this->section('script');

?>

<script>
    $(document).ready(function() {
        const baseUrl = "<?= site_url('ref'); ?>";
        const tokenValue = "<?= \csrf_hash() ?>";
        <?= view('referensi/js/bidang.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>