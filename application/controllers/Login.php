<?php

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('MLogin');

        if($this->session->userdata('status') == 'login_absen'){
			redirect(base_url());
		}
    }

    function index()
    {
        $this->load->view('login');
    }

    function prosesLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'user_name' => $username,
            'password' => $password
        );
        $cek = $this->MLogin->cekLogin($where);

        $notif = '';
        
        if (sizeof($cek) > 0) {
            $data_session = array(
                'nama' => $username,
                'akses' => $cek[0]->deptAkses,
                'status' => "login_absen"
            );
            
            $this->session->set_userdata($data_session);
            
            redirect(base_url());
        } else {
            $notif = 'login-err';
            $this->session->set_flashdata('notifikasi', $notif);
            redirect('login');
        }
    }
}
