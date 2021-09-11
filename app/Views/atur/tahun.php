<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header card-header-border-bottom">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd">
                    <i class="mdi mdi-plus"></i>
                    Tambah
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-striped" id="tabelData" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tahun</th>
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
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdd">Tambah Tahun</h5>
            </div>
            <?= form_open('#', ['id' => 'formAdd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="tahun" class="form-label">* Tahun</label>
                    <input type="text" name="tahun" id="tahun" class="form-control" required>
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

<?php

echo $this->endSection('content');

echo $this->section('script');

?>

<script>
    $(document).ready(function() {
        const baseUrl = "<?= site_url('atur'); ?>";
        const tokenValue = "<?= \csrf_hash() ?>";
        <?= view('atur/js/tahun.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>