<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MKaryawan');

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

        $this->load->model('MUnit');

        $data['karyawan'] = $this->MKaryawan->listAll()->result();
        $data['unit'] = $this->MUnit->listAll()->result();

        $this->load->view('_layout/head', array(
            'judul' => 'Daftar Karyawan',
            'user' => $this->session->userdata('nama')
        ));
        $this->load->view('karyawan/index', $data);
        $this->load->view('_layout/foot');
        $this->load->view('karyawan/index_js');
        $this->load->view('_layout/closing');
    }

    public function listByUnit($unit_id)
    {
        header("Content-Type: application/json");
		$find = $this->MKaryawan->listByUnit($unit_id);
		echo json_encode($find->result());
    }

    public function get($id)
    {
        header("Content-Type: application/json");
		$find = $this->MKaryawan->get($id);
		echo json_encode($find->result());
    }

    public function search()
    {
        header("Content-Type: application/json");
        $data = array('cari' => $this->input->get('term'));

        $find = $this->MKaryawan->search($data);

        echo json_encode($find->result());
    }

    public function save()
    {
        $data = array(
            'fid' => $this->input->post('fid'),
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'dept_name' => $this->input->post('dept_name'),
            'jabatan' => $this->input->post('jabatan'),
            'tgl_masuk' => $this->input->post('tgl_masuk')
        );
        $save = $this->MKaryawan->save($data);
        $notif = '';
        if ($save) {
            $notif = 'save-ok';
        } else {
            $notif = 'save-err';
        }
        $this->session->set_flashdata('notifikasi', $notif);
        redirect('karyawan');
    }

    public function delete($id)
    {
        $data = array('fid' => $id);
        $delete = $this->MKaryawan->delete($data);
        $notif = '';
        if ($delete) {
            $notif = 'hapus-ok';
        } else {
            $notif = 'hapus-err';
        }
        $this->session->set_flashdata('notifikasi', $notif);
        redirect('karyawan');
    }
}