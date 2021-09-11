<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row clearfix">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd">
                    <i class="mdi mdi-plus"></i>
                    Tambah
                </button>
            </div>
            <div class="card-body table-responsive-lg">
                <table class="table table-hover table-striped" id="tabelData" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>KODE</th>
                            <th>SKPD</th>
                            <th>Tipe</th>
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
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalAdd">Tambah Unit</h4>
            </div>
            <?= form_open('#', ['id' => 'formAdd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kode" class="form-label">* Kode SKPD</label>
                    <input type="text" name="kode" id="kode" class="form-control" required>

                </div>
                <div class="form-group">
                    <label for="skpd">* Nama Unit / Sub Unit</label>
                    <input type="text" name="skpd" id="skpd" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="skpd">* Tipe</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipe" id="unit" value="1" checked>
                        <label class="form-check-label" for="unit">Unit</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipe" id="subunit" value="0">
                        <label class="form-check-label" for="subunit">Sub Unit</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bidangurusan1">Bidang Urusan 1</label>
                    <select name="bidangurusan1" id="bidangurusan1" class="form-control">
                        <option value="">--pilih bidang urusan 1--</option>
                        <?php
                        foreach ($bidang as $b) {
                            echo "<option>$b->nama_bidang_urusan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bidangurusan2">Bidang Urusan 2</label>
                    <select name="bidangurusan2" id="bidangurusan2" class="form-control">
                        <option value="">--pilih bidang urusan 2--</option>
                        <?php
                        foreach ($bidang as $b) {
                            echo "<option>$b->nama_bidang_urusan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bidangurusan3">Bidang Urusan 3</label>
                    <select name="bidangurusan3" id="bidangurusan3" class="form-control">
                        <option value="">--pilih bidang urusan 3--</option>
                        <?php
                        foreach ($bidang as $b) {
                            echo "<option>$b->nama_bidang_urusan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bidangurusan4">Bidang Urusan 4</label>
                    <select name="bidangurusan4" id="bidangurusan4" class="form-control">
                        <option value="">--pilih bidang urusan 4--</option>
                        <?php
                        foreach ($bidang as $b) {
                            echo "<option>$b->nama_bidang_urusan</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" id="submitAdd">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                    <label for="x_kode">* Kode</label>
                    <input type="text" name="x_kode" id="x_kode" class="form-control">
                </div>
                <div class="form-group">
                    <label for="x_skpd">* Nama Unit / Sub Unit</label>
                    <input type="text" name="x_skpd" id="x_skpd" class="form-control">
                </div>
                <div class="form-group">
                    <label>* Tipe</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="x_tipe" id="x_unit" value="1">
                        <label class="form-check-label" for="x_unit">Unit</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="x_tipe" id="x_subunit" value="0">
                        <label class="form-check-label" for="x_subunit">Sub Unit</label>
                    </div>
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
        <?= view('unit/js/skpd.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>