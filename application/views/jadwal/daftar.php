<div id="app" style="font-size: .8em;">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Pilih Unit</label>
                <select name="dept_name" v-model="dept" @change="parseJadwal" class="form-control" 
                required
                <?php
                if (
                    $this->session->userdata('akses') != 'a000000042'
                    && $this->session->userdata('akses') != 'a000000004'
                ) {
                    echo 'disabled';
                }
                ?>>
                    <option value=""></option>
                    <?php foreach ($unit as $u) { ?>
                        <option value="<?php echo $u->IdUnit ?>"><?php echo $u->Namaunit ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Bulan</label>
                <select name="bulan" v-model="bulan" @change="parseJadwal" class="form-control">
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
                <select name="tahun" v-model="tahun" @change="parseJadwal" class="form-control">
                    <?php $max_year = date('Y');
                    for($i = 2020; $i <= $max_year; $i++) {?>
                        <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3 offset-md-2">
            <div class="form-group text-right">
                <label style="display: block">&nbsp;</label>
                <button class="btn btn-secondary" @click="edit" :disabled="jadwal_all.length === 0">
                    <i class="fas fa-pencil-alt"></i>
                    Edit
                </button>
                <button class="btn btn-primary" @click="unduhExcel" :disabled="jadwal_all.length === 0">
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
                <div class="card-body table-responsive p-0" style="height: 60vh;">
                    <table class="table table-hover table-bordered table-head-fixed table-col-fixed table-sm double-header" id="main-table" >
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2">Nama</th>
                                <th :class="{ 'text-danger': dayName(tanggal) === 'MG' }" class="text-center" v-for="tanggal in tanggals" :key="tanggal">{{ dayName(tanggal) }}</th>
                            </tr>
                            <tr>
                                <th :class="{ 'text-danger': dayName(tanggal) === 'MG' }" class="text-center" v-for="tanggal in tanggals" :key="tanggal">{{ tanggal }}</th>
                            </tr>
                        </thead>
                        <tbody v-if="jadwal_all.length > 0">
                            <tr class="baris-jadwal" v-for="(karyawan, index_k) in jadwal_all" :key="index_k">
                                <td>{{ index_k + 1 }}</td>
                                <td>
                                    {{ karyawan.nama }}
                                    <br>
                                    <span class="jam-kerja">Total Jam Kerja: <b>{{ karyawan.total_jam }}</b></span>
                                </td>
                                <td :class="{ 'text-danger': tanggal.nama_jadwal === '', 'libur': dayName(parseInt(tanggal.tanggal.split('/')[0])) === 'MG' }" v-for="(tanggal, index_t) in karyawan.jadwal" :key="index_t">
									{{ tanggal.nama_jadwal === '' ? 'X' : tanggal.nama_jadwal }}
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <td :colspan="tanggals + 2" class="text-center text-muted"><i>Tidak ada data</i></td>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Keterangan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-bordered table-sm" id="ket-table">
                        <thead>
                            <tr>
                                <th style="width: 3%;"></th>
                                <th>Jadwal</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(shift, index) in shifts" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ shift.nama_jadwal }}</td>
                                <td>{{ shift.jam_masuk }}</td>
                                <td>{{ shift.jam_keluar }}</td>
                            </tr>
                            <tr>
                                <td>{{ shifts.length + 1 }}</td>
                                <td>X</td>
                                <td>Libur/Tidak Ada Jadwal</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>