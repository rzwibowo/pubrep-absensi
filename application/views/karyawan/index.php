<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table class="table table-hover table-sm" id="main-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>FID</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jabatan</th>
                            <th>Nama Unit</th>
                            <th>Tanggal Masuk</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($karyawan as $k) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $k->fid ?></td>
                                <td><?php echo $k->nama ?></td>
                                <td><?php echo $k->nik ?></td>
                                <td><?php echo $k->jabatan ?></td>
                                <td><?php echo $k->namaunit ?></span></td>
                                <td><?php echo $k->tgl_masuk ?></span></td>
                                <td>
                                    <button onclick="edit(<?php echo $k->fid ?>)" class="btn btn-outline-secondary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button onclick="hapus('<?php echo $k->fid ?>')" class="btn btn-outline-secondary btn-sm">
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
                            Tambah Karyawan
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
            <form action="<?php echo base_url() ?>karyawan/save" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Data Karyawan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>FID</label>
                                <input name="fid" type="number" step="1" class="form-control" required>
                                <div id="invalid-fid" class="invalid-feedback" style="display: none;">
                                    FID sudah ada
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>NIK</label>
                                <input name="nik" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="nama" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="dept_name" class="form-control" required>
                            <?php foreach ($unit as $u) { ?>
                                <option value="<?php echo $u->IdUnit ?>"><?php echo $u->Namaunit ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input name="jabatan" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input name="tgl_masuk" type="text" class="form-control">
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