<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <!-- Button trigger modal -->
                <a type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#modalAdd">
                    <i class="material-icons">add</i>
                    <span>Tambah</span>
                </a>
            </div>
            <div class="body table-responsive">
                <table class="table table-hover table-striped" id="tabelData" style="width: 100%;">
                    <thead class="bg-grey">
                        <tr>
                            <th>#</th>
                            <th>Satuan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAdd" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdd">Tambah Satuan</h5>
            </div>
            <?= form_open('#', ['id' => 'formAdd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <div class="form-line">
                        <input type="text" name="satuan" id="satuan" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Batal</button>
                <input type="submit" id="submitAdd" class="btn btn-success btn-lg" value="Simpan">
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalAdd" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">Edit Satuan</h5>
            </div>
            <?= form_open('#', ['id' => 'formEdit']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="x_satuan">Satuan</label>
                    <div class="form-line">
                        <input type="text" name="x_satuan" id="x_satuan" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id">
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Batal</button>
                <input type="submit" id="submitEdit" class="btn btn-success btn-lg" value="Simpan">
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>



<?php

echo $this->endSection('content');

echo $this->section('script');

?>

<script>
    $(document).ready(function() {
        const baseUrl = "<?= site_url('referensi'); ?>";
        const tokenValue = "<?= \csrf_hash() ?>";
        <?= view('referensi/js/satuan.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>