<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd">
                    <i class="mdi mdi-plus"></i>
                    Tambah
                </button>
                <a href="<?= site_url('atur/menu') ?>" class="btn btn-primary"><i class="mdi mdi-menu"></i> Menu Setting</a>
                <a href="<?= site_url('atur/role') ?>" class="btn btn-primary"><i class="mdi mdi-settings"></i> Role Setting</a>
            </div>
            <div class="card-body table-responsive-md">
                <table class="table table-hover table-striped" id="tabelData" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>SKPD</th>
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
<div class="modal fade" id="modalAdd" role="dialog" aria-labelledby="modalAdd" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdd">Tambah User</h5>
            </div>
            <?= form_open('#', ['id' => 'formAdd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="user">* Username</label>
                    <input type="text" name="user" id="user" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="role">* Role / Hak Akses</label>
                    <select name="role" id="role" class="form-control select2" required>
                        <option value="">--pilih role--</option>
                        <?php
                        foreach ($role as $r) {
                            echo "<option value='$r->id_role'>$r->role</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="skpd">SKPD</label>
                    <select name="skpd" id="skpd" class="form-control select2">
                        <option value="">--pilih skpd--</option>
                        <?php
                        foreach ($skpd as $s) {
                            echo "<option value='$s->id_skpd'>$s->nama_skpd</option>";
                        }
                        ?>
                    </select>
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
                <h5 class="modal-title" id="modalEdit">Edit User</h5>
            </div>
            <?= form_open('#', ['id' => 'formEdit']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="x_nama">Nama Lengkap</label>
                    <input type="text" name="x_nama" id="x_nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="x_user">* Username</label>
                    <input type="text" name="x_user" id="x_user" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="x_role">* Role / Hak Akses</label>
                    <select name="x_role" id="x_role" class="form-control select2" required>
                        <option value="">--pilih role--</option>
                        <?php
                        foreach ($role as $r) {
                            echo "<option value='$r->id_role'>$r->role</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="x_skpd">SKPD</label>
                    <select name="x_skpd" id="x_skpd" class="form-control select2" data-live-search="true">
                        <option value="">--pilih skpd--</option>
                        <?php
                        foreach ($skpd as $s) {
                            echo "<option value='$s->id_skpd'>$s->nama_skpd</option>";
                        }
                        ?>
                    </select>
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
        <?= view('atur/js/user.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>