<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MUnit');

        if ($this->session->userdata('status') != 'login_absen') {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        if ($this->session->userdata('akses') != 'a000000042' 
            && $this->session->userdata('akses') != 'a000000004') {
            redirect('errorLayer/e_403');
        }

        $data['unit'] = $this->MUnit->listAll()->result();

        $this->load->view('_layout/head', array(
            'judul' => 'Daftar Unit/Bagian',
            'user' => $this->session->userdata('nama')
        ));
        $this->load->view('unit/index', $data);
        $this->load->view('_layout/foot');
        $this->load->view('unit/index_js');
        $this->load->view('_layout/closing');
    }

    public function get($id)
    {
        header("Content-Type: application/json");
		$find = $this->MUnit->get($id);
		echo json_encode($find->result());
    }

    public function save()
    {
        $data = array(
            'idunit' => $this->input->post('idunit'),
            'namaunit' => $this->input->post('namaunit'),
            'nodelevel' => 1,
            'anakunit' => 'a',
            'disuser' => 1
        );
        $save = $this->MUnit->save($data);
        $notif = '';
        if ($save) {
            $notif = 'save-ok';
        } else {
            $notif = 'save-err';
        }
        $this->session->set_flashdata('notifikasi', $notif);
        redirect('unit');
    }

    public function cekNama($par)
    {
        header("Content-Type: application/json");
		$find = $this->MUnit->cekNama($par);
		echo json_encode($find->result());
    }

    public function delete($id)
    {
        $data = array('idunit' => $id);
        $delete = $this->MUnit->delete($data);
        $notif = '';
        if ($delete) {
            $notif = 'hapus-ok';
        } else {
            $notif = 'hapus-err';
        }
        $this->session->set_flashdata('notifikasi', $notif);
        redirect('unit');
    }
}