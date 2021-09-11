<?php
echo $this->extend('layout/template');

echo $this->section('content');

?>

<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6 col-lg-6 col-md-6">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd">
                            <i class="mdi mdi-plus"></i>
                            Tambah
                        </button>
                    </div>
                    <div class="col-sm-6 col-lg-6 col-md-6 text-right">
                        <a href="<?= site_url('atur/menu') ?>" class="btn btn-pill btn-outline-primary">
                            <i class="mdi mdi-reply"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover" id="tabelData" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Sub Menu</th>
                            <th>Link</th>
                            <th>Order</th>
                            <th>Ket.</th>
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
                <h5 class="modal-title" id="modalAdd">Tambah Sub Menu</h5>
            </div>
            <?= form_open('#', ['id' => 'formAdd']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="sub_menu" class="form-label">* Uraian Sub Menu</label>
                    <input type="text" name="sub_menu" id="sub_menu" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="link" class="form-label">* Menu Link</label>
                    <textarea name="link" id="link" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="order">* Order</label>
                    <input type="number" name="order" id="order" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <input type="text" name="ket" id="ket" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_menu" value="<?= $menu->id_menu ?>">
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
        const idMenu = "<?= $menu->id_menu ?>";
        const tokenValue = "<?= \csrf_hash() ?>";
        <?= view('atur/js/sub_menu.js'); ?>
    });
</script>
<?php

echo $this->endSection('script');
?>