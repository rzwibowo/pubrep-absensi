<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Rentang Tanggal</label>
                            <input name="tgl_search" id="tgl_search" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pencarian</label>
                            <div class="input-group mb-3">
                                <input type="search" name="pencarian" class="form-control" placeholder="Nama Karyawan/Unit">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="btn-cari">
                                        Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive pt-0">
                <table class="table table-hover table-sm" id="main-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama Karyawan</th>
                            <th>Unit</th>
                            <th>Tanggal Cuti</th>
                            <th>Alasan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-3 offset-md-9 text-right">
                        <button type="button" class="btn btn-primary" onclick="openModal()">
                            <i class="fas fa-plus"></i>
                            Tambah Cuti/Izin
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
            <form action="<?php echo base_url() ?>izin/save" method="POST">
                <input name="id" type="hidden">
                <div class="modal-header">
                    <h4 class="modal-title">Data Izin/Cuti</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input name="nama" type="text" class="form-control">
                        <input name="fid" type="hidden" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Jatah Cuti: <strong>12</strong>, Sisa Cuti Tahun Ini: <strong id="sisa">12</strong></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input name="tgl_mulai" type="text" autocomplete="off" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input name="tgl_selesai" type="text" autocomplete="off" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Jumlah Hari: <strong id="jumlah">1</strong></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alasan</label>
                        <input name="alasan" type="text" class="form-control" required>
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