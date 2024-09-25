<script src="<?php echo base_url() ?>assets/plugins/axios/axios.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
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

    const col_def = [{
            searchable: false,
            targets: [0, -1]
        },
        {
            orderable: false,
            targets: [-1]
        }
    ]

    let main_table = $('#main-table').DataTable({
        // responsive: true
        stateSave: true,
        searching: false,
        columnDefs: col_def
    })

    $('#tgl_search').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
        showDropdowns: true
    }, function(start, end, label) {
        let nama = ''
        if ($('input[name=pencarian]').val().trim().length > 0) {
            nama = $('input[name=pencarian]').val().trim()
        }

        cari(start.format('DD-MM-YYYY'), end.format('DD-MM-YYYY'), nama)
    })

    $('#btn-cari').click(function() {
        if ($('input[name=pencarian]').val().trim().length > 1) {
            const tgl_awal = moment($('#tgl_search').data('daterangepicker').startDate).format('DD-MM-YYYY')
            const tgl_akhir = moment($('#tgl_search').data('daterangepicker').endDate).format('DD-MM-YYYY')
            const nama = $('input[name=pencarian]').val().trim()

            cari(tgl_awal, tgl_akhir, nama)
        } else {
            listAll100()
        }
    })

    $('input[name=pencarian]').keypress(function(e) {
        if (e.which == 13) {
            if ($('input[name=pencarian]').val().trim().length > 1) {
                const tgl_awal = moment($('#tgl_search').data('daterangepicker').startDate).format('DD-MM-YYYY')
                const tgl_akhir = moment($('#tgl_search').data('daterangepicker').endDate).format('DD-MM-YYYY')
                const nama = $('input[name=pencarian]').val().trim()

                cari(tgl_awal, tgl_akhir, nama)
            } else {
                listAll100()
            }
        }
    })

    function listAll100() {
        axios.get('<?php echo base_url() ?>izin/list100/')
            .then(res => {
                main_table.destroy()

                const data_izin = res.data.map((item, index) => {
                    return `<tr>
                            <td width="3">${index + 1}</td>
                            <td>${item.nama}</td>
                            <td>${item.namaunit}</td>
                            <td>${item.tglijin}</td>
                            <td>${item.alasan}</td>
                            <td>
                                <button class="btn btn-default btn-sm" 
                                    onclick="hapus(${item.fid}, '${item.tglijin}')" 
                                    title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>`
                }).join('')
                $('#main-table tbody').html(data_izin)

                tabel_utama = $('#main-table').DataTable({
                    stateSave: true,
                    searching: false,
                    columnDefs: col_def
                })
            })
            .catch(err => alert('Terjadi kesalahan, ' + err))
    }

    listAll100()

    function cari(tgl_awal, tgl_akhir, nama = '') {
        axios.get(`<?php echo base_url() ?>izin/search/${tgl_awal}/${tgl_akhir}/${nama}`)
            .then(res => {
                const rows = res.data.map((item, index) => {
                    let data = `<tr>
                            <td width="3">${index + 1}</td>
                            <td>${item.nama}</td>
                            <td>${item.namaunit}</td>
                            <td>${item.tglijin}</td>
                            <td>${item.alasan}</td>
                            <td>
                                <button class="btn btn-default btn-sm" 
                                    onclick="hapus(${item.fid}, '${item.tglijin}')" 
                                    title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>`
                    return data
                })
                $('#main-table tbody').html(rows.join(''))
            })
    }

    $('input[name=tgl_mulai], input[name=tgl_selesai]').datepicker({
        dateFormat: 'dd/mm/yy'
    })

    $('input[name=tgl_mulai], input[name=tgl_selesai]').change(function() {
        const tgl_awal_ = $('input[name=tgl_mulai]').val()
        const tgl_akhir_ = $('input[name=tgl_selesai]').val()

        let jumlah = 0

        if (tgl_awal_.trim().length > 0 && tgl_akhir_.trim().length > 0) {
            const tgl_awal = moment(tgl_awal_, 'DD/MM/YYYY')
            const tgl_akhir = moment(tgl_akhir_, 'DD/MM/YYYY')

            jumlah = tgl_akhir.diff(tgl_awal, 'days') + 1
        }

        $('#jumlah').text(jumlah)
    })

    $('input[name=nama]').autocomplete({
        source: "<?php echo base_url() ?>karyawan/search/",
        minLength: 3,
        select: function(event, ui) {
            $('input[name=nama]').val(ui.item.nama)
            $('input[name=fid]').val(ui.item.fid)

            axios.get('<?php echo base_url() ?>izin/sisaCutiByFid/' + ui.item.fid)
                .then(res => {
                    $('#sisa').text(res.data.sisacuti)
                })

            return false
        }
    }).autocomplete("instance")._renderItem = function(ul, item) {
        return $("<li>")
            .append("<div>" + item.nama + " (" + item.namaunit + ")</div>")
            .appendTo(ul)
    }

    function openModal() {
        resetModal()

        $('#modal-overlay').modal('show')
    }

    function resetModal() {
        $('input[name=fid]').val('')
        $('input[name=nama]').val('')
        $('input[name=tgl_mulai]').val('')
        $('input[name=tgl_selesai]').val('')
        $('input[name=alasan]').val('')

        $('#sisa').text('12')
        $('#jumlah').text('1')
    }

    function hapus(fid, tanggal) {
        Swal.fire({
            title: 'Hapus Data?',
            text: 'Hapus Data Cuti?',
            type: 'warning',
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                const tanggal_ = tanggal.replace(/\//g, '-')
                axios.get('<?php echo base_url() ?>izin/delete/' + fid + '/' + tanggal_)
                    .then(res => {
                        if (res.data.status === 'delete-ok') {
                            Toast.fire({
                                type: 'success',
                                title: 'Berhasil hapus data'
                            })

                            $('input[name=pencarian]').val('')
                            listAll100()
                        } else {
                            Toast.fire({
                                type: 'error',
                                title: 'Gagal hapus data'
                            })
                        }
                    })
            }
        })
    }
</script>