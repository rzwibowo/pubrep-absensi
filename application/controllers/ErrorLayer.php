<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ErrorLayer extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function e_403()
	{
		$this->load->view('403');
	}
}
