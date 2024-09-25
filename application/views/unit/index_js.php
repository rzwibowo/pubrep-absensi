<script src="<?php echo base_url() ?>assets/plugins/axios/axios.min.js"></script>
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

    function edit(id) {
        is_edit = true
        resetModal()

        axios.get('<?php echo base_url() ?>unit/get/' + id)
            .then(res => {
                const data_ = res.data[0]

                $('input[name=idunit]').val(data_.IdUnit)
                $('input[name=namaunit]').val(data_.Namaunit)

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
        $('input[name=idunit]').val('')
        $('input[name=namaunit]').val('')

        $('#invalid-fid').hide()
        $('input[name=namaunit]').removeClass('is-invalid')
    }

    function cekFid(nama) {
        axios.get('<?php echo base_url() ?>unit/cekNama/' + nama)
            .then(res => {
                if (res.data.length > 0) {
                    $('#invalid-fid').show()
                    $('input[name=namaunit]').addClass('is-invalid')
                } else {
                    $('#invalid-fid').hide()
                    $('input[name=namaunit]').removeClass('is-invalid')
                }
            })
            .catch(err => alert('Terjadi kesalahan, ' + err))
    }

    $('input[name=namaunit]').change(function() {
        if (!is_edit && $(this).val().trim().length > 0) {
            cekFid($(this).val())
        }
    })

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Data',
            type: 'warning',
            text: 'Yakin hapus data unit?',
            showCancelButton: true
        }).then(result => {
            if (result.value) {
                location.assign('<?php echo base_url() ?>unit/delete/' + id)
            }
        })
    }
</script>