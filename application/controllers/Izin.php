<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MIzin');

        if ($this->session->userdata('status') != 'login_absen') {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $this->load->view('_layout/head', array(
            'judul' => 'Daftar Izin/Cuti',
            'user' => $this->session->userdata('nama')
        ));
        $this->load->view('izin/index');
        $this->load->view('_layout/foot');
        $this->load->view('izin/index_js');
        $this->load->view('_layout/closing');
    }

    public function list100()
    {
        header("Content-Type: application/json");
        $find = $this->MIzin->list100();
        echo json_encode($find->result());
    }

    public function sisaCutiByFid($fid)
    {
        header("Content-Type: application/json");
        $find = $this->MIzin->sisaCutiByFid($fid);

        $data = new stdClass();

        $data->sisacuti = 12 - $find->result()[0]->jumlah_cuti;
        echo json_encode($data);
    }

    // public function get($id)
    // {
    //     header("Content-Type: application/json");
    // 	$find = $this->MKaryawan->get($id);
    // 	echo json_encode($find->result());
    // }

    public function search($tgl_awal, $tgl_akhir, $nama = '')
    {
        header("Content-Type: application/json");
        $tgl_awal_ = str_replace('-', '/', $tgl_awal);
        $tgl_akhir_ = str_replace('-', '/', $tgl_akhir);

        $tanggals_ = $this->rentangTanggal($tgl_awal_, $tgl_akhir_);
        $tanggals = [];
        foreach ($tanggals_ as $t) {
            array_push($tanggals, $t->format('d/m/Y'));
        }

        $data['tanggals'] = $tanggals;
        if ($nama != '') {
            $data['nama'] = $nama;
        }

        $find = $this->MIzin->search($data);
        echo json_encode($find->result());
    }

    public function save()
    {
        $data = [];

        $tanggals = $this->rentangTanggal(
            $this->input->post('tgl_mulai'),
            $this->input->post('tgl_selesai')
        );

        foreach ($tanggals as $t) {
            array_push($data, array(
                'fid' => $this->input->post('fid'),
                'idijin' => -1,
                'tipeijin' => 1,
                'tglijin' => $t->format('d/m/Y'),
                'alasan' => $this->input->post('alasan'),
                'tglinput' => date('d/m/Y H:i:s'),
                'userinput' => $this->session->userdata('nama'),
                'tahunijin' => date('Y')
            ));
        }

        $save = $this->MIzin->save($data);
        $notif = '';
        if ($save) {
            $notif = 'save-ok';
        } else {
            $notif = 'save-err';
        }
        $this->session->set_flashdata('notifikasi', $notif);
        redirect('izin');
    }

    public function delete($fid, $tglijin)
    {
        header("Content-Type: application/json");

        $data = array(
            'fid' => $fid,
            'tglijin' => str_replace('-', '/', $tglijin)
        );
        $delete = $this->MIzin->delete($data);

        $result = new stdClass();

        if ($delete) {
            $result->status = 'delete-ok';
        } else {
            $result->status = 'delete-err';
        }

        echo json_encode($result);
    }

    private function rentangTanggal($tgl_awal__, $tgl_akhir__)
    {
        $tgl_awal_ = explode('/', $tgl_awal__);
        $tgl_akhir_ = explode('/', $tgl_akhir__);

        $tgl_awal = implode('-', array_reverse($tgl_awal_));
        $tgl_akhir = implode('-', array_reverse($tgl_akhir_));

        $interval = new DateInterval('P1D');

        $o_tgl_awal = new DateTime($tgl_awal);
        $o_tgl_akhir = new DateTime($tgl_akhir);
        $o_tgl_akhir = $o_tgl_akhir->add($interval);

        $tanggals = new DatePeriod($o_tgl_awal, $interval, $o_tgl_akhir);

        return $tanggals;
    }
}
