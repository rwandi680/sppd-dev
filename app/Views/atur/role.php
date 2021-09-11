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
                <a href="<?= site_url('atur/menu') ?>" class="btn btn-primary"><i class="mdi mdi-menu"></i> Menu Setting</a>
                <a href="<?= site_url('atur/user') ?>" class="btn btn-primary"><i class="mdi mdi-account"></i> User Setting</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover" id="tabelData" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Uraian</th>
                            <th>Keterangan</th>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdd">Tambah Role</h5>
            </div>
            <?= form_open('#', ['id' => 'formAdd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="role" class="form-label">* Uraian Role</label>
                    <input type="text" name="role" id="role" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="ket" class="form-label">Keterangan</label>
                    <input type="text" name="ket" id="ket" class="form-control">
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

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">Edit Role</h5>
            </div>
            <?= form_open('#', ['id' => 'formEdit']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="x_role" class="form-label">* Uraian Role</label>
                    <input type="text" name="x_role" id="x_role" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="x_ket" class="form-label">Keterangan</label>
                    <input type="text" name="x_ket" id="x_ket" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" id="submitEdit">Simpan</button>
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
        <?= view('atur/js/role.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>