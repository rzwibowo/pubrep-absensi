<div id="app" style="font-size: .8em;">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Pilih Unit</label>
                <select name="dept_name" v-model="dept" @change="parseJadwal" class="form-control" required>
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
        <div class="col-md-2 offset-md-3">
            <div class="form-group text-right">
                <label style="display: block">&nbsp;</label>
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
                    <table class="table table-hover table-bordered table-striped table-head-fixed table-col-fixed table-sm double-header laporan" id="main-table" >
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2">Nama</th>
                                <th class="text-center" :class="{ 'text-danger libur': dayName(tanggal) === 'MG' }" colspan="4" v-for="tanggal in tanggals" :key="tanggal">{{ tanggal }}</th>
                            </tr>
                            <tr>
                                <template v-for="tanggal in tanggals">
                                    <th class="text-center"><abbr title="Jam Masuk">M</abbr></th>
                                    <th class="text-center"><abbr title="Jam Absen">A</abbr></th>
                                    <th class="text-center"><abbr title="Keterlambatan (dalam Menit)">L</abbr></th>
                                    <th class="text-center"><abbr title="Potongan (Rp)">P</abbr></th>
                                </template>
                            </tr>
                        </thead>
                        <tbody v-if="jadwal_all.length > 0">
                            <tr class="baris-jadwal" v-for="(karyawan, index_k) in jadwal_all" :key="index_k">
                                <td>{{ index_k + 1 }}</td>
                                <td>
                                    {{ karyawan.nama }}
                                </td>
                                <template v-for="tanggal in karyawan.kehadiran">
                                    <td class="text-center" :class="{'text-danger': tanggal.jam_masuk === 'C'}">
                                        {{ tanggal.jam_masuk === '' ? 'X' : tanggal.jam_masuk }}
                                    </td>
                                    <td class="text-center" :class="{'text-danger': tanggal.jam_masuk !== '' && tanggal.jam_masuk !== 'C' && tanggal.jam_absen === ''}">
                                        {{ tanggal.jam_absen === '' ? 'X' : tanggal.jam_absen.substring(0, 5) }}
                                    </td>
                                    <td class="text-center" :class="{'text-danger': tanggal.jam_masuk !== '' && tanggal.lambat > 0}">
                                        {{ tanggal.lambat }}
                                    </td>
                                    <td class="text-center" :class="{'text-danger': tanggal.potongan_lambat > 0}">
                                        {{ tanggal.potongan_lambat }}
                                    </td>
                                </template>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <td :colspan="tanggals * 4 + 2" class="text-center text-muted"><i>Tidak ada data</i></td>
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
                    <h3 class="card-title">Total Potongan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-bordered table-sm" id="ket-table">
                        <thead>
                            <tr>
                                <th style="width: 3%;"></th>
                                <th>Nama</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody v-if="potongan_all.length > 0">
                            <tr v-for="(potongan, index) in potongan_all" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ potongan.nama }}</td>
                                <td class="text-right">{{ potongan.total_potongan | currencyFormat }}</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <td colspan="3" class="text-center text-muted"><i>Tidak ada data</i></td>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>