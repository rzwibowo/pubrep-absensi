<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('MHome');

		if ($this->session->userdata('status') != 'login_absen') {
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		$this->load->view('_layout/head', array(
			'judul' => 'Halaman Utama',
			'user' => $this->session->userdata('nama')
		));
		$this->load->view('home');
		$this->load->view('_layout/foot');
		$this->load->view('_layout/closing');
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
