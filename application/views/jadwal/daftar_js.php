<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/axios/axios.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/vue/vue.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/FileSaver/FileSaver.min.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script> -->
<script>
    let notif = ''

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
                dept: '<?php echo $this->session->userdata('akses') ?>',
                bulan: '',
                tahun: '',
                tanggals: 0,
                shifts: [],
                namaHari: ['MG', 'SN', 'SL', 'RB',
                    'KM', 'JM', 'SB'
                ],
                jadwal_all: []
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
                this.bulan = moment().format('M')
                this.tahun = moment().format('Y')
            },
            dayName: function(day) {
                const day_fmt = day.toString().padStart(2, '0')
                const month_fmt = this.bulan.padStart(2, '0')
                const date = new Date(`${this.tahun}-${month_fmt}-${day_fmt}`)
                return this.namaHari[date.getDay()]
            },
            setJumlahHari: function() {
                this.tanggals = new Date(this.tahun, this.bulan, 0).getDate()
            },
            formatTgl: function(tgl) {
                const day_fmt = tgl.toString().padStart(2, '0')
                const month_fmt = this.bulan.padStart(2, '0')
                return `${day_fmt}/${month_fmt}/${this.tahun}`
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
                                this.hitungJam()
                            }
                        })
                        .catch(err => alert('Terjadi kesalahan, ' + err))
                }
            },
            hitungJam: function() {
                this.jadwal_all.forEach((item, index) => {
                    const total_jam = item.jadwal.reduce((total, item_j) => {
                        return total + item_j.durasi
                    }, 0)
                    this.jadwal_all[index].total_jam = total_jam
                })
            },
            parseJadwal: function() {
                this.setJumlahHari()
                this.loadJadwal()
            },
            loadShift: function() {
                axios.get('<?php echo base_url() ?>shift/listAll')
                    .then(res => {
                        this.shifts = res.data
                    })
            },
            unduhExcel: function() {
                let data_jadwal_ = $('#main-table').clone()
                $(data_jadwal_).find('.jam-kerja').remove()
                $(data_jadwal_).find('br').remove()

                const unit = $('select[name=dept_name] option:selected').text()
                const bulan = $('select[name=bulan] option:selected').text()
                const tahun = $('select[name=tahun] option:selected').text()

                const data_jadwal = data_jadwal_.html()
                const data_keterangan = $('#ket-table').clone().html()

                const data = {
                    unit: unit,
                    bulan: bulan,
                    tahun: tahun,
                    jadwal: data_jadwal,
                    keterangan: data_keterangan
                }

                axios.post('<?php echo base_url() ?>jadwal/cetak', data)
                    .then(res => {
                        const blob = new Blob([res.data], {
                            type: "application/vnd.ms-excel;charset=utf-8"
                        });
                        saveAs(blob, `Jadwal Kerja ${tahun}_${bulan}_${unit}.xls`)
                    })
                    .catch(err => alert('Terjadi kesalahan, ' + err))
            },
            edit: function () {
                const month_fmt = this.bulan.padStart(2, '0')

                location.assign('<?php echo base_url() ?>jadwal/inputJadwal/' +
                    this.dept + '/' + month_fmt + '/' + this.tahun)
            }
        }
    })
</script>