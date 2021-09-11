<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd">
                    <i class="mdi mdi-plus"></i> Tambah
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-striped" id="tabelData" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tahun</th>
                            <th>Uraian</th>
                            <th>Keterangan</th>
                            <th>Status</th>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdd">Tambah Tahapan</h5>
            </div>
            <?= form_open('#', ['id' => 'formAdd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="tahapan">* Uraian Tahapan</label>
                    <input type="text" name="tahapan" id="tahapan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <input type="text" name="ket" id="ket" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <input type="submit" id="submitAdd" class="btn btn-success" value="Simpan">
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">Edit Tahapan</h5>
            </div>
            <?= form_open('#', ['id' => 'formEdit']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="x_tahapan">* Uraian Tahapan</label>
                    <input type="text" name="x_tahapan" id="x_tahapan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="x_ket">Keterangan</label>
                    <input type="text" name="x_ket" id="x_ket" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <input type="submit" id="submitEdit" class="btn btn-success" value="Simpan">
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
        const baseUrl = "<?= site_url('atur'); ?>";
        const tokenValue = "<?= \csrf_hash() ?>";
        <?= view('atur/js/tahapan.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>