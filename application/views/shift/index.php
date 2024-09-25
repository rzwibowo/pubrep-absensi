<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table class="table table-hover table-sm" id="main-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama Shift</th>
                            <th>Nama Jadwal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($shift as $s) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $s->nama_jadwal ?></td>
                                <td><?php echo $s->nama_shift ?></td>
                                <td><?php echo $s->jam_masuk ?></td>
                                <td><?php echo $s->jam_keluar ?></td>
                                <td>
                                    <button onclick="edit('<?php echo $s->id ?>')" class="btn btn-outline-secondary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button onclick="hapus('<?php echo $s->id ?>', '<?php echo $s->id_shift ?>')" class="btn btn-outline-secondary btn-sm">
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
                            Tambah Shift
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
            <form action="<?php echo base_url() ?>shift/save" method="POST">
                <input name="id" type="hidden">
                <input name="id_shift" type="hidden">
                <div class="modal-header">
                    <h4 class="modal-title">Data Shift</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Shift</label>
                        <input name="nama_jadwal" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Jadwal</label>
                        <input name="nama_shift" type="text" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam Masuk</label>
                                <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                    <input type="text" name="jam_masuk" class="form-control datetimepicker-input" data-target="#datetimepicker3" />
                                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam Keluar</label>
                                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                    <input type="text" name="jam_keluar" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input name="chk_besok" value="1" class="form-check-input" type="checkbox">
                                Beda Hari
                            </label>
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