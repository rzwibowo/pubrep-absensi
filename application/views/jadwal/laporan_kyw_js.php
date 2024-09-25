<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/axios/axios.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/FileSaver/FileSaver.min.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script> -->
<script>
    function defaultTime() {
        $('select[name=bulan]').val(moment().format('M'))
        $('select[name=tahun]').val(moment().format('Y'))
    }
    defaultTime()

    const empty_table = `<tr>
        <td colspan="5" class="text-center text-muted">
            <i>Tidak ada data</i>
        </td>
    </tr>`
    $('#main-table tbody').html(empty_table)

    $('input[name=pencarian]').autocomplete({
        source: "<?php echo base_url() ?>karyawan/search/",
        minLength: 3,
        select: function(event, ui) {
            $('input[name=pencarian]').val(ui.item.nama + " (" + (ui.item.namaunit ?? '-') + ")")
            $('input[name=fid]').val(ui.item.fid)
            $('input[name=namaunit]').val(ui.item.namaunit ?? '-')

            return false
        }
    }).autocomplete("instance")._renderItem = function(ul, item) {
        return $("<li>")
            .append("<div>" + item.nama + " (" + (item.namaunit ?? '-') + ")</div>")
            .appendTo(ul)
    }

    $('#btn-cari').click(function() {
        getLaporan()
    })

    $('#btn-unduh').click(function() {
        unduhExcel()
    })

    $('select[name=bulan]').change(function() {
        getLaporan()
    })

    $('select[name=tahun]').change(function() {
        getLaporan()
    })

    function getLaporan() {
        if ($('input[name=fid]').val().trim().length > 0) {
            getDataLaporan()
        }
    }

    function getDataLaporan() {
        const month_fmt = $('select[name=bulan]').val().padStart(2, '0')

        axios.get('<?php echo base_url() ?>jadwal/laporanPerKaryawan/' +
                $('input[name=fid]').val() + '/' + month_fmt + '/' + $('select[name=tahun]').val())
            .then(res => {
                const data = res.data
                let total_potongan = 0

                if (data.length > 0) {
                    const table_data = data.map(item => {
                        total_potongan += item.potongan_lambat

                        let row = `<tr>
                            <td`
                        if (dayName(item.tanggal.split('/')[0]) === 'MG') {
                            row += ` class="text-danger libur"`
                        }
                        row += `>${item.tanggal.split('/')[0]}</td>
                            <td`
                        if (item.jam_masuk === 'C') {
                            row += ` class="text-danger"`
                        }
                        row += `>${ item.jam_masuk === '' ? 'X' : item.jam_masuk }</td>
                            <td`
                        if (item.jam_masuk !== '' && item.jam_masuk !== 'C' && item.jam_absen === '') {
                            row += ` class="text-danger"`
                        }
                        row += `>${ item.jam_absen === '' ? 'X' : item.jam_absen.substring(0, 5) }</td>
                        <td`
                        if (item.jam_masuk !== '' && item.lambat > 0) {
                            row += ` class="text-danger"`
                        }
                        row += `>${ item.lambat }</td>
                        <td`
                        if (item.potongan_lambat > 0) {
                            row += ` class="text-danger"`
                        }
                        row += `>${ item.potongan_lambat }</td>
                        </tr>`

                        return row
                    }).join('')

                    $('#btn-unduh').prop('disabled', false)
                    $('#main-table tbody').html(table_data)
                    $('#potongan').text(total_potongan)
                } else {
                    $('#btn-unduh').prop('disabled', true)
                    $('#main-table tbody').html(empty_table)
                    $('#potongan').text(0)
                }
            })
            .catch(err => alert('Terjadi kesalahan, ' + err))
    }

    function unduhExcel() {
        let data_jadwal_ = $('#main-table').clone()

        const nama = $('input[name=pencarian]').val().split('(')[0].trim()
        const unit = $('input[name=namaunit]').val()
        const bulan = $('select[name=bulan] option:selected').text()
        const tahun = $('select[name=tahun] option:selected').text()

        const data_jadwal = data_jadwal_.html().replace(/tfoot/g, 'tbody')
        const data = {
            nama: nama,
            unit: unit,
            bulan: bulan,
            tahun: tahun,
            jadwal: data_jadwal
        }

        axios.post('<?php echo base_url() ?>jadwal/cetaklapkar', data)
            .then(res => {
                const blob = new Blob([res.data], {
                    type: "application/vnd.ms-excel;charset=utf-8"
                });
                saveAs(blob, `Laporan Kehadiran ${tahun}_${bulan}_${nama}.xls`)
            })
            .catch(err => alert('Terjadi kesalahan, ' + err))
    }

    function dayName(tanggal) {
        const nama_hari = ['MG', 'SN', 'SL', 'RB', 'KM', 'JM', 'SB']
        const day_fmt = tanggal.toString().padStart(2, '0')
        const month_fmt = $('select[name=bulan]').val().padStart(2, '0')
        const date = new Date(`${$('select[name=tahun]').val()}-${month_fmt}-${day_fmt}`)
        return nama_hari[date.getDay()]
    }
</script>