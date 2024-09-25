<script src="<?php echo base_url() ?>assets/plugins/axios/axios.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
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

    $('#datetimepicker3, #datetimepicker4').datetimepicker({
        format: 'HH:mm'
    });

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

    function edit(id) {
        is_edit = true
        resetModal()

        axios.get('<?php echo base_url() ?>shift/get/' + id)
            .then(res => {
                const data_ = res.data[0]

                $('input[name=id]').val(data_.id)
                $('input[name=id_shift]').val(data_.id_shift)
                $('input[name=nama_shift]').val(data_.nama_shift)
                $('input[name=nama_jadwal]').val(data_.nama_jadwal)
                $('input[name=jam_masuk]').val(data_.jam_masuk)
                $('input[name=jam_keluar]').val(data_.jam_keluar)

                if (parseInt(data_.chk_besok) === 1) {
                    $('input[name=chk_besok]').prop('checked', true)
                }

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
        $('input[name=id]').val('')
        $('input[name=id_shift]').val('')
        $('input[name=nama_shift]').val('')
        $('input[name=nama_jadwal]').val('')
        $('input[name=jam_masuk]').val('')
        $('input[name=jam_keluar]').val('')
        $('input[name=chk_besok]').prop('checked', false)
    }

    function hapus(id, id_shift) {
        Swal.fire({
            title: 'Hapus Data',
            type: 'warning',
            text: 'Yakin hapus data shift?',
            showCancelButton: true
        }).then(result => {
            if (result.value) {
                location.assign('<?php echo base_url() ?>shift/delete/' + id + '/' + id_shift)
            }
        })
    }
</script>