<script src="<?php echo base_url() ?>assets/plugins/axios/axios.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script> -->
<script>
    let notif = ''
    let is_edit = false

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
        case 'hapus-ok':
            Toast.fire({
                type: 'success',
                title: 'Berhasil hapus data'
            })
            break
        case 'hapus-err':
            Toast.fire({
                type: 'error',
                title: 'Gagal hapus data'
            })
            break

        default:
            break
    }

    $('#main-table').DataTable({
        // responsive: true
        stateSave: true,
        columnDefs: [{
                searchable: false,
                targets: [0, -1]
            },
            {
                orderable: false,
                targets: [-1]
            }
        ]
    })

    $('input[name=tgl_masuk]').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        yearRange: '1900:2500'
    })

    function edit(id) {
        is_edit = true
        resetModal()

        axios.get('<?php echo base_url() ?>karyawan/get/' + id)
            .then(res => {
                const data_ = res.data[0]

                $('input[name=fid]').val(data_.FID)
                $('input[name=nama]').val(data_.Nama)
                $('input[name=nik]').val(data_.NIK)
                $('select[name=dept_name]').val(data_.DEPT_NAME)
                $('input[name=jabatan]').val(data_.JABATAN)
                $('input[name=tgl_masuk]').val(data_.TGL_MASUK)

                $('#modal-overlay').modal('show')
            })
            .catch(err => alert('Terjadi kesalahan, ' + err))
    }

    function openModal() {
        is_edit = false
        resetModal()

        $('#modal-overlay').modal('show')
    }

    function resetModal() {
        $('input[name=fid]').val('')
        $('input[name=nama]').val('')
        $('input[name=nik]').val('')
        $('select[name=dept_name]').val('')
        $('input[name=jabatan]').val('')
        $('input[name=tgl_masuk]').val('')

        $('#invalid-fid').hide()
        $('input[name=fid]').removeClass('is-invalid')
    }

    function cekFid(id) {
        axios.get('<?php echo base_url() ?>karyawan/get/' + id)
            .then(res => {
                if (res.data.length > 0) {
                    $('#invalid-fid').show()
                    $('input[name=fid]').addClass('is-invalid')
                } else {
                    $('#invalid-fid').hide()
                    $('input[name=fid]').removeClass('is-invalid')
                }
            })
            .catch(err => alert('Terjadi kesalahan, ' + err))
    }

    $('input[name=fid]').change(function() {
        if (!is_edit && $(this).val().trim().length > 0) {
            cekFid($(this).val())
        }
    })

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Data',
            type: 'warning',
            text: 'Yakin hapus data karyawan?',
            showCancelButton: true
        }).then(result => {
            if (result.value) {
                location.assign('<?php echo base_url() ?>karyawan/delete/' + id)
            }
        })
    }
</script>