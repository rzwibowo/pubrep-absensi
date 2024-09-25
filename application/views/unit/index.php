<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table class="table table-hover table-sm" id="main-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama Unit/Bagian</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($unit as $u) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $u->Namaunit ?></td>
                                <td>
                                    <button onclick="edit('<?php echo $u->IdUnit ?>')" class="btn btn-outline-secondary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button onclick="hapus('<?php echo $u->IdUnit ?>')" class="btn btn-outline-secondary btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-3 offset-md-9 text-right">
                        <button type="button" class="btn btn-primary" onclick="openModal()">
                            <i class="fas fa-plus"></i>
                            Tambah Unit/Bagian
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

<div class="modal fade" id="modal-overlay">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() ?>unit/save" method="POST">
                <input name="idunit" type="hidden">
                <div class="modal-header">
                    <h4 class="modal-title">Data Unit/Bagian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Unit/Bagian</label>
                        <input name="namaunit" type="text" class="form-control" required>
                        <div id="invalid-fid" class="invalid-feedback" style="display: none;">
                            Unit sudah ada
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>