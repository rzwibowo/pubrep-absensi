<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shift extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MShift');

        if ($this->session->userdata('status') != 'login_absen') {
            redirect(base_url('login'));
        }
    }

    public function listAll()
    {
        header("Content-Type: application/json");
        $this->load->helper('timediff');

        $find = $this->MShift->listAll();
        $data = $find->result();
        for ($i = 0; $i < sizeof($data); $i++) {
            $data[$i]->durasi = getTimeDiff($data[$i]->jam_masuk, $data[$i]->jam_keluar);
        }
        echo json_encode($data);
    }

    public function index()
    {
        if ($this->session->userdata('akses') != 'a000000042' 
            && $this->session->userdata('akses') != 'a000000004') {
            redirect('errorLayer/e_403');
        }

        $data['shift'] = $this->MShift->listAll()->result();

        $this->load->view('_layout/head', array(
            'judul' => 'Daftar Shift Kerja',
            'user' => $this->session->userdata('nama')
        ));
        $this->load->view('shift/index', $data);
        $this->load->view('_layout/foot');
        $this->load->view('shift/index_js');
        $this->load->view('_layout/closing');
    }

    public function get($id)
    {
        header("Content-Type: application/json");
		$find = $this->MShift->get($id);
		echo json_encode($find->result());
    }

    public function save()
    {
        $chk_besok = $this->input->post('chk_besok') != '' ? $this->input->post('chk_besok') : 0;
        
        $data = array(
            'id' => $this->input->post('id'),
            'id_shift' => $this->input->post('id_shift'),
            'nama_shift' => $this->input->post('nama_shift'),
            'nama_jadwal' => $this->input->post('nama_jadwal'),
            'jam_masuk' => $this->input->post('jam_masuk'),
            'jam_keluar' => $this->input->post('jam_keluar'),
            'chk_besok' => $chk_besok
        );

        $save = $this->MShift->save($data);
        $notif = '';
        if ($save) {
            $notif = 'save-ok';
        } else {
            $notif = 'save-err';
        }
        $this->session->set_flashdata('notifikasi', $notif);
        redirect('shift');
    }

    public function delete($id, $id_shift)
    {
        $data = array('id' => $id, 'id_shift' => $id_shift);
        $delete = $this->MShift->delete($data);
        $notif = '';
        if ($delete) {
            $notif = 'hapus-ok';
        } else {
            $notif = 'hapus-err';
        }
        $this->session->set_flashdata('notifikasi', $notif);
        redirect('shift');
    }
}
