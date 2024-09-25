<div id="app" style="font-size: .8em;">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Pilih Unit</label>
                <select name="dept_name" v-model="dept" @change="loadKaryawan" class="form-control" 
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
                <select name="bulan" v-model="bulan" @change="setJumlahHari" class="form-control">
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
                <select name="tahun" v-model="tahun" @change="setJumlahHari" class="form-control">
                    <?php $max_year = date('Y');
                    for ($i = 2020; $i <= $max_year + 1; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label style="display: block;">Ragam Jadwal</label>
            <button :class="{ 'active-ring': shift.id === temp_jadwal.id, 
                'btn-primary': setTipeShift(shift.nama_jadwal) === 'P', 
                'btn-warning': setTipeShift(shift.nama_jadwal) === 'S',
                'btn-secondary': setTipeShift(shift.nama_jadwal) === 'M',
                'btn-info': setTipeShift(shift.nama_jadwal) === 'MdP'
                    || setTipeShift(shift.nama_jadwal) === 'MdS'}" class="btn btn-sm mr-1 mb-1" v-for="shift in shifts" :key="shift.id" @click="temp_jadwal = shift" :title="shift.nama_shift">
                {{ shift.nama_jadwal }}
            </button>
            <button :class="{ 'active-ring': temp_jadwal.id === -99 }" class="btn btn-sm btn-danger mr-1 mb-1" @click="temp_jadwal = libur">
                X
            </button>
            <a href="#ket-jadwal">Keterangan</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 80vh;">
                    <table class="table table-hover table-bordered table-head-fixed table-col-fixed table-sm double-header" id="main-table">
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2">Nama</th>
                                <th class="text-center" :class="{ 'text-danger': dayName(tanggal) === 'MG' }" v-for="tanggal in tanggals" :key="tanggal">{{ dayName(tanggal) }}</th>
                            </tr>
                            <tr>
                                <th class="text-center" :class="{ 'text-danger': dayName(tanggal) === 'MG' }" v-for="tanggal in tanggals" :key="tanggal">{{ tanggal }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="baris-jadwal" v-for="(karyawan, index_k) in jadwal_all" :key="index_k">
                                <td>{{ index_k + 1 }}</td>
                                <td>
                                    {{ karyawan.nama }}
                                    <br>
                                    Total Jam Kerja: <b>{{ karyawan.total_jam }}</b>
                                </td>
                                <td :class="{ 'libur': dayName(parseInt(tanggal.tanggal.split('/')[0])) === 'MG' }" v-for="(tanggal, index_t) in karyawan.jadwal" :key="index_t">
                                    <button :class="{ 'btn-primary': setTipeShift(showNamaJadwal(jadwal_all[index_k].jadwal[index_t].nojadwal)) === 'P', 
                                        'btn-warning': setTipeShift(showNamaJadwal(jadwal_all[index_k].jadwal[index_t].nojadwal)) === 'S',
                                        'btn-secondary': setTipeShift(showNamaJadwal(jadwal_all[index_k].jadwal[index_t].nojadwal)) === 'M',
                                        'btn-info': setTipeShift(showNamaJadwal(jadwal_all[index_k].jadwal[index_t].nojadwal)) === 'MdP'
                                            || setTipeShift(showNamaJadwal(jadwal_all[index_k].jadwal[index_t].nojadwal)) === 'MdS',
                                        'btn-danger': jadwal_all[index_k].jadwal[index_t].nojadwal === -99,
                                        'btn-default': !jadwal_all[index_k].jadwal[index_t].nojadwal }" class="btn btn-sm btn-block" style="white-space: nowrap;" @click="setJadwal(index_k, index_t)">
                                        {{ showNamaJadwal(jadwal_all[index_k].jadwal[index_t].nojadwal) }}
                                    </button>
                                    <!-- <div class="form-check">
                                        <label class="form-check-label" v-for="shift in shifts" :key="shift.id">
                                            <input type="radio" class="form-check-input" :name="'jadwal_' + karyawan.fid + '_' + index_t" :value="shift.id" v-model="jadwal_all[index_k].jadwal[index_t].nojadwal" @click="hitungJam(index_k, index_t, shift.durasi)">
                                            {{ shift.nama_jadwal }}
                                        </label>
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" :name="'jadwal_' + karyawan.fid + '_' + index_t" value="-99" v-model="jadwal_all[index_k].jadwal[index_t].nojadwal" @click="hitungJam(index_k, index_t, 0)">
                                            X
                                        </label>
                                    </div> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" @click="simpan" :disabled="isLoading || jadwal_all.length === 0">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-show="isLoading"></span>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="row" id="ket-jadwal">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Shift</th>
                                <th>Nama Jadwal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(shift, index) in shifts" :key="index" :class="{ 'table-primary': setTipeShift(shift.nama_jadwal) === 'P', 
                                    'table-warning': setTipeShift(shift.nama_jadwal) === 'S',
                                    'table-secondary': setTipeShift(shift.nama_jadwal) === 'M',
                                    'table-info': setTipeShift(shift.nama_jadwal) === 'MdP'
                                        || setTipeShift(shift.nama_jadwal) === 'MdS'}">
                                <td>{{ index + 1 }}</td>
                                <td>{{ shift.nama_jadwal }}</td>
                                <td>{{ shift.nama_shift }}</td>
                                <td>{{ shift.jam_masuk }}</td>
                                <td>{{ shift.jam_keluar }}</td>
                            </tr>
                            <tr class="table-danger">
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