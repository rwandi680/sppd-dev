<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAdd">
                    <i class="mdi mdi-plus"></i> Tambah
                </button>
                <a href="<?= site_url('atur/role') ?>" class="btn btn-primary"><i class="mdi mdi-settings"></i> Role Setting</a>
                <a href="<?= site_url('atur/user') ?>" class="btn btn-primary"><i class="mdi mdi-account"></i> User Setting</a>
            </div>
            <div class="card-body table table-responsive-md">
                <table class="table table-hover" id="tabelData" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Sub Menu</th>
                            <th>Icon</th>
                            <th>Link</th>
                            <th>Order</th>
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
                <h5 class="modal-title" id="modalAdd">Tambah Menu</h5>
            </div>
            <?= form_open('#', ['id' => 'formAdd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="menu" class="form-label">* Uraian Menu</label>
                    <input type="text" name="menu" id="menu" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sub_menu">
                        <input type="checkbox" name="sub_mnu" id="sub_menu" value="TRUE" class="">
                        Sub Menu
                    </label>
                </div>
                <div class="form-group">
                    <label for="icon" class="form-label">* Menu Icons</label>
                    <input type="text" name="icon" id="icon" class="form-control" placeholder="Material Design Icons" required>
                </div>
                <div class="form-group">
                    <label for="link" class="form-label">* Menu Link</label>
                    <textarea name="link" id="link" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="order">* Menu Order</label>
                    <input type="number" name="order" id="order" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
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
                <h5 class="modal-title" id="modalEdit">Edit Menu</h5>
            </div>
            <?= form_open('#', ['id' => 'formEdit']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="x_menu" class="form-label">* Uraian Menu</label>
                    <input type="text" name="x_menu" id="x_menu" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="x_sub_menu" class="form-control-label">
                        <input type="checkbox" name="x_sub_menu" id="x_sub_menu" value="TRUE">
                        Sub Menu
                    </label>
                </div>
                <div class="form-group">
                    <label for="x_icon" class="form-label">* Menu Icons</label>
                    <input type="text" name="x_icon" id="x_icon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="x_link" class="form-label">* Menu Link</label>
                    <textarea name="x_link" id="x_link" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="x_order">* Order</label>
                    <input type="number" name="x_order" id="x_order" class="form-control">
                </div>
                <div class="form-group">
                    <label for="x_ket">Keterangan</label>
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
        <?= view('atur/js/menu.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>