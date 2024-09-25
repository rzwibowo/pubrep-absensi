<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MUser');

        if ($this->session->userdata('status') != 'login_absen') {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        if ($this->session->userdata('akses') != 'a000000042') {
            redirect('errorLayer/e_403');
        }

        $this->load->model('MUnit');
     
        $data['user'] = $this->MUser->listAll()->result();
        $data['unit'] = $this->MUnit->listAll()->result();

        $this->load->view('_layout/head', array(
            'judul' => 'Daftar User',
            'user' => $this->session->userdata('nama')
        ));
        $this->load->view('user/index', $data);
        $this->load->view('_layout/foot');
        $this->load->view('user/index_js');
        $this->load->view('_layout/closing');
    }

    public function get($id)
    {
        header("Content-Type: application/json");
		$find = $this->MUser->get($id);
		echo json_encode($find->result());
    }

    public function save()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'user_name' => $this->input->post('user_name'),
            'password' => $this->input->post('password'),
            'deptakses' => $this->input->post('deptakses')
        );
        $save = $this->MUser->save($data);
        $notif = '';
        if ($save) {
            $notif = 'save-ok';
        } else {
            $notif = 'save-err';
        }
        $this->session->set_flashdata('notifikasi', $notif);
        redirect('user');
    }

    public function cekNama($par)
    {
        header("Content-Type: application/json");
		$find = $this->MUser->cekNama($par);
		echo json_encode($find->result());
    }

    public function delete($id)
    {
        $data = array('id' => $id);
        $delete = $this->MUser->delete($data);
        $notif = '';
        if ($delete) {
            $notif = 'hapus-ok';
        } else {
            $notif = 'hapus-err';
        }
        $this->session->set_flashdata('notifikasi', $notif);
        redirect('user');
    }
}