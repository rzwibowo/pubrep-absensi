<div id="app" style="font-size: .8em;">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Bulan</label>
                <select name="bulan" class="form-control">
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Tahun</label>
                <select name="tahun" class="form-control">
                    <?php $max_year = date('Y');
                    for ($i = 2020; $i <= $max_year; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Cari Karyawan</label>
                <div class="input-group mb-3">
                    <input type="hidden" name="fid">
                    <input type="hidden" name="namaunit">
                    <input type="text" name="pencarian" class="form-control" placeholder="Nama Karyawan">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="btn-cari">
                            Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 offset-md-2">
            <div class="form-group text-right">
                <label style="display: block">&nbsp;</label>
                <button class="btn btn-primary" id="btn-unduh" disabled>
                    <i class="fas fa-file-excel"></i>
                    Unduh Excel
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-bordered table-striped table-sm" id="main-table" >
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Absen</th>
                                <th>Menit Terlambat</th>
                                <th>Potongan</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right">Total potongan</td>
                                <td id="potongan">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>