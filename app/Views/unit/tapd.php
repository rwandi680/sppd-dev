<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row clearfix">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Seketariat TAPD</h4>
            </div>
            <div class="card-body table-responsive-md">
                <table class="table table-striped" id="tabelData" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Uraian</th>
                            <th>Alamat TAPD</th>
                            <th>Kota</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="text-dark">Penandatangan Dokumen</h4>
            </div>
            <div class="card-body table-responsive-md">
                <table class="table table-striped" id="tabelDataTtd" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalEdit">Edit TAPD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('#', ['id' => 'formEdit']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="uraian">* Uraian</label>
                    <input type="text" name="uraian" id="uraian" class="form-control">
                </div>
                <div class="form-group">
                    <label for="alamat">* Alamat TAPD</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input type="text" name="kota" id="kota" class="form-control">
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

<!-- Modal Tambah TTd -->
<div class="modal fade" id="modalTambahTtd" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalEdit">Penandatangan Dokumen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('#', ['id' => 'formTambahTtd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">* Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nip">* NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jabatan">* Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" class="form-control" required>
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
        const baseUrl = "<?= site_url('verifarea'); ?>";
        const tokenValue = "<?= \csrf_hash() ?>";
        <?= view('unit/js/tapd.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>