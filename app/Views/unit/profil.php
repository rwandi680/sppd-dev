<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row clearfix">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark"><?= $skpd->kode_skpd . ' ' . $skpd->nama_skpd ?></h4>
            </div>
            <div class="card-body table-responsive-md">
                <table class="table table-hover table-striped" id="tabelData" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Kepala</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Alamat SKPD</th>
                            <th>Kota</th>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalEdit">Edit Unit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('#', ['id' => 'formEdit']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_kepala">* Nama Kepala</label>
                    <input type="text" name="nama_kepala" id="nama_kepala" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nip">* NIP. Kepala</label>
                    <input type="text" name="nip" id="nip" class="form-control">
                </div>
                <div class="form-group">
                    <label>* Jabatan Kepala</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jabatan" id="kepala" value="1">
                        <label class="form-check-label" for="kepala">Kepala SKPD</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jabatan" id="plt" value="2">
                        <label class="form-check-label" for="plt">Plt. Kepala</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">* Alamat SKPD</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="kota">* Kota</label>
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



<?php

echo $this->endSection('content');

echo $this->section('script');

?>

<script>
    $(document).ready(function() {
        const baseUrl = "<?= site_url('userarea'); ?>";
        const tokenValue = "<?= \csrf_hash() ?>";
        <?= view('unit/js/profil.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>