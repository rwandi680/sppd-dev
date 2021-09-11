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
                    <thead class="bg-indigo">
                        <tr>
                            <th>#</th>
                            <th>Jenis Belanja</th>
                            <th>Objek Belanja</th>
                            <th>Referensi Akun</th>
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
                <h5 class="modal-title" id="modalAdd">Tambah Satuan</h5>
            </div>
            <?= form_open('#', ['id' => 'formAdd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="jenis">Jenis Belanja</label>
                    <div class="form-line">
                        <input type="text" name="jenis" id="jenis" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="objek">Objek Belanja</label>
                    <div class="form-line">
                        <input type="text" name="objek" id="objek" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_ref">Referensi Akun</label>
                    <div class="form-line">
                        <input type="text" name="is_ref" id="is_ref" class="form-control" required>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">Edit Satuan</h5>
            </div>
            <?= form_open('#', ['id' => 'formEdit']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="x_jenis">Jenis Belanja</label>
                    <div class="form-line">
                        <input type="text" name="x_jenis" id="x_jenis" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="x_objek">Objek Belanja</label>
                    <div class="form-line">
                        <input type="text" name="x_objek" id="x_objek" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="x_is_ref">Referensi Akun</label>
                    <div class="form-line">
                        <input type="text" name="x_is_ref" id="x_is_ref" class="form-control" required>
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
        <?= view('referensi/js/jenisbl.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>