<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/axios/axios.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/vue/vue.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/FileSaver/FileSaver.min.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script> -->
<script>
    const main_script = new Vue({
        el: '#app',
        data: function() {
            return {
                dept: '',
                bulan: '',
                tahun: '',
                tanggals: 0,
                namaHari: ['MG', 'SN', 'SL', 'RB',
                    'KM', 'JM', 'SB'
                ],
                jadwal_all: [],
                potongan_all: []
            }
        },
        mounted: function() {
            this.setDefaultTime()
            this.setJumlahHari()
        },
        filters: {
            currencyFormat: function(nominal) {
                const fmt_nominal = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(parseInt(nominal))
                return fmt_nominal
            }
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
                    this.potongan_all = []
                    
                if (this.tanggals > 0 && this.dept !== '') {
                    const month_fmt = this.bulan.padStart(2, '0')

                    axios.get('<?php echo base_url() ?>jadwal/laporanPerUnit/' +
                            this.dept + '/' + month_fmt + '/' + this.tahun)
                        .then(res => {
                            const data = res.data
                            if (data.length > 0) {
                                this.jadwal_all = data


                                this.potongan_all = data.map(item => {
                                    const potongan = item.kehadiran.reduce((total, item_) => {
                                        return total + parseInt(item_.potongan_lambat)
                                    }, 0)

                                    return {
                                        nama: item.nama,
                                        total_potongan: potongan
                                    }
                                })

                            }
                        })
                        .catch(err => alert('Terjadi kesalahan, ' + err))
                }
            },
            parseJadwal: function() {
                this.setJumlahHari()
                this.loadJadwal()
            },
            unduhExcel: function() {
                let data_jadwal_ = $('#main-table').clone()

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

                axios.post('<?php echo base_url() ?>jadwal/cetaklap', data)
                    .then(res => {
                        const blob = new Blob([res.data], {
                            type: "application/vnd.ms-excel;charset=utf-8"
                        });
                        saveAs(blob, `Laporan Kehadiran ${tahun}_${bulan}_${unit}.xls`)
                    })
                    .catch(err => alert('Terjadi kesalahan, ' + err))
            }
        }
    })
</script>