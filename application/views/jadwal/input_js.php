<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/axios/axios.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/vue/vue.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script> -->
<script>
    let notif = ''
    let jml_hari = 0

    <?php if ($this->session->flashdata('notifikasi') != null) echo "notif='" . $this->session->flashdata('notifikasi') . "';" ?>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    })

    switch (notif) {
        case 'save-ok':
            Toast.fire({
                type: 'success',
                title: 'Berhasil simpan data'
            })
            break
        case 'save-err':
            Toast.fire({
                type: 'error',
                title: 'Gagal simpan data'
            })
            break

        default:
            break
    }

    const main_script = new Vue({
        el: '#app',
        data: function() {
            return {
                dept: '<?php if ($this->uri->segment(3) != '') {
                            echo $this->uri->segment(3);
                        } else {
                            echo $this->session->userdata('akses');
                        } ?>',
                bulan: '',
                tahun: '',
                tanggals: 0,
                karyawans: [],
                shifts: [],
                namaHari: ['MG', 'SN', 'SL', 'RB',
                    'KM', 'JM', 'SB'
                ],
                jadwal_all: [],
                temp_jadwal: {},
                libur: {
                    id: -99,
                    nama_jadwal: 'X',
                    durasi: 0
                },
                isLoading: false
            }
        },
        mounted: function() {
            this.loadShift()
            this.setDefaultTime()
            this.setJumlahHari()
            this.loadJadwal()
        },
        methods: {
            setDefaultTime: function() {
                let bulan = '<?php echo (int)$this->uri->segment(4) ?>'
                let tahun = '<?php echo $this->uri->segment(5) ?>'

                if (bulan === '' || bulan === '0') {
                    bulan = moment().format('M')
                }

                if (tahun === '') {
                    tahun = moment().format('Y')
                }

                this.bulan = bulan
                this.tahun = tahun
            },
            dayName: function(day) {
                const day_fmt = day.toString().padStart(2, '0')
                const month_fmt = this.bulan.padStart(2, '0')
                const date = new Date(`${this.tahun}-${month_fmt}-${day_fmt}`)
                return this.namaHari[date.getDay()]
            },
            setJumlahHari: function() {
                this.tanggals = new Date(this.tahun, this.bulan, 0).getDate()

                for (i = 0; i < this.jadwal_all.length; i++) {
                    const jadwal_personal = this.jadwal_all[i].jadwal;

                    const selisih = this.tanggals - jadwal_personal.length
                    if (selisih > 0) {
                        let tanggal_tambah = jadwal_personal.length
                        for (k = 0; k < selisih; k++) {
                            this.jadwal_all[i].jadwal.push({
                                durasi: 0,
                                nama_jadwal: "",
                                nojadwal: "",
                                tanggal: `${++tanggal_tambah}/${this.bulan.padStart(2, '0')}/${this.tahun}`
                            })
                        }
                    } else if (selisih < 0) {
                        this.jadwal_all[i].jadwal = this.jadwal_all[i].jadwal.splice(-selisih)
                    }

                    for (j = 0; j < jadwal_personal.length; j++) {
                        const split_tanggal = jadwal_personal[j].tanggal.split("/")
                        const tanggal_baru = `${split_tanggal[0]}/${this.bulan.padStart(2, '0')}/${this.tahun}`

                        this.jadwal_all[i].jadwal[j].tanggal = tanggal_baru
                    }
                }
            },
            loadKaryawan: function() {
                this.karyawans = []
                this.jadwal_all = []

                if (this.tanggals > 0 && this.dept !== '') {
                    axios.get('<?php echo base_url() ?>karyawan/listByUnit/' + this.dept)
                        .then(res => {
                            this.karyawans = res.data

                            this.jadwal_all = this.karyawans.map(item => {
                                const jadwal_ = []
                                for (let i = 1; i <= this.tanggals; i++) {
                                    jadwal_.push({
                                        nojadwal: null,
                                        tanggal: this.formatTgl(i),
                                        durasi: 0
                                    })
                                }
                                return {
                                    fid: item.FID,
                                    nama: item.Nama,
                                    jadwal: jadwal_,
                                    total_jam: 0
                                }
                            })
                        })
                }
            },
            loadJadwal: function() {
                this.jadwal_all = []

                if (this.tanggals > 0 && this.dept !== '') {
                    const month_fmt = this.bulan.padStart(2, '0')

                    axios.get('<?php echo base_url() ?>jadwal/listByUnit/' +
                            this.dept + '/' + month_fmt + '/' + this.tahun)
                        .then(res => {
                            this.jadwal_all = []
                            const data = res.data
                            if (res.data.length > 0) {
                                this.jadwal_all = res.data
                                res.data.forEach((item, index) => {
                                    item.jadwal.forEach((item_, index_) => {
                                        this.hitungJam(index, index_, item_.durasi)
                                    })
                                })
                            }
                        })
                        .catch(err => alert('Terjadi kesalahan, ' + err))
                }
            },
            loadShift: function() {
                axios.get('<?php echo base_url() ?>shift/listAll')
                    .then(res => {
                        this.shifts = res.data
                    })
            },
            setJadwal: function(index_k, index_t) {
                if (Object.entries(this.temp_jadwal).length === 0) {
                    alert('Mohon pilih ragam jadwal dahulu')
                } else {
                    this.jadwal_all[index_k].jadwal[index_t].nojadwal = this.temp_jadwal.id
                    if (this.temp_jadwal.id === -99) {
                        this.hitungJam(index_k, index_t, 0)
                    } else {
                        this.hitungJam(index_k, index_t, this.temp_jadwal.durasi)
                    }
                }
            },
            setTipeShift: function(nama_shift) {
                return nama_shift.split(' ')[0]
            },
            showNamaJadwal: function(id) {
                let nama_jadwal = 'X'
                if (id) {
                    if (id !== -99) {
                        nama_jadwal = this.shifts.filter(item => {
                            return item.id === id
                        })[0].nama_jadwal
                    } else {
                        nama_jadwal = 'X'
                    }
                }
                return nama_jadwal
            },
            formatTgl: function(tgl) {
                const day_fmt = tgl.toString().padStart(2, '0')
                const month_fmt = this.bulan.padStart(2, '0')
                return `${day_fmt}/${month_fmt}/${this.tahun}`
            },
            simpan: function() {
                this.isLoading = true
                axios.post('<?php echo base_url() ?>jadwal/save',
                        this.jadwal_all)
                    .then(res => {
                        if (res.data.status === 'save-ok') {
                            Toast.fire({
                                type: 'success',
                                title: 'Berhasil simpan data'
                            })
                        } else {
                            Toast.fire({
                                type: 'error',
                                title: 'Gagal simpan data'
                            })
                        }
                    })
                    .catch(err => {
                        alert('Terjadi kesalahan, ' + err)
                    })
                    .then(() => this.isLoading = false)
            },
            hitungJam: function(index_k, index_t, durasi) {
                this.jadwal_all[index_k].jadwal[index_t].durasi = durasi
                const total_jam = this.jadwal_all[index_k].jadwal.reduce((total, item_j) => {
                    return total + item_j.durasi
                }, 0)
                this.jadwal_all[index_k].total_jam = total_jam
            }
        }
    })
</script>