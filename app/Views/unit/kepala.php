<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <!-- Button trigger modal -->
                <a type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalAdd">
                    <i class="material-icons">add</i>
                    <span>Tambah</span>
                </a>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="tabelData" width="100%">
                        <thead class="bg-indigo">
                            <tr>
                                <th>#</th>
                                <th>SKPD</th>
                                <th>Nama Lengkap</th>
                                <th>NIP</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAdd" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdd">Tambah Unit</h5>
            </div>
            <?= form_open('#', ['id' => 'formAdd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kode">* SKPD</label>
                    <select name="skpd" id="skpd" class="form-control show-tick" data-live-search="true" required>
                        <option>--pilih skpd--</option>
                        <?php
                        foreach ($skpd as $s) {
                            echo "<option value='$s->id_skpd'>$s->skpd</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">* Nama Lengkap</label>
                    <div class="form-line">
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nip">* NIP</label>
                    <div class="form-line">
                        <input type="text" name="nip" id="nip" class="form-control" required>
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

<!-- Modal edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">Edit Unit</h5>
            </div>
            <?= form_open('#', ['id' => 'formEdit']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kode">* SKPD</label>
                    <select name="x_skpd" id="x_skpd" class="form-control show-tick" data-live-search="true" required>
                        <option value="">--pilih skpd--</option>
                        <?php
                        foreach ($skpd as $s) {
                            echo "<option value='$s->id_skpd'>$s->skpd</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="x_nama">* Nama Lengkap</label>
                    <div class="form-line">
                        <input type="text" name="x_nama" id="x_nama" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="x_nip">* NIP</label>
                    <div class="form-line">
                        <input type="text" name="x_nip" id="x_nip" class="form-control" required>
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
        const baseUrl = "<?= site_url('unit'); ?>";
        const tokenValue = "<?= \csrf_hash() ?>";
        <?= view('unit/js/kepala.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>