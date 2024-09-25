<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MJadwal');

        if ($this->session->userdata('status') != 'login_absen') {
            redirect(base_url('login'));
        }
    }

    // public function index()
    // {
    //     $this->load->model('MUnit');

    //     $data['unit'] = $this->MUnit->listAll()->result();

    //     $this->load->view('_layout/head', array(
    //         'judul' => 'Daftar Jadwal',
    //         'user' => $this->session->userdata('nama')
    //     ));
    //     $this->load->view('jadwal/index', $data);
    //     $this->load->view('_layout/foot');
    //     $this->load->view('jadwal/index_js');
    //     $this->load->view('_layout/closing');
    // }

    public function inputJadwal()
    {
        $this->load->model('MUnit');

        $data['unit'] = $this->MUnit->listAll()->result();

        $this->load->view('_layout/head', array(
            'judul' => 'Input Jadwal',
            'user' => $this->session->userdata('nama')
        ));
        $this->load->view('jadwal/input', $data);
        $this->load->view('_layout/foot');
        $this->load->view('jadwal/input_js');
        $this->load->view('_layout/closing');
    }

    public function daftar()
    {
        $this->load->model('MUnit');

        $data['unit'] = $this->MUnit->listAll()->result();

        $this->load->view('_layout/head', array(
            'judul' => 'Daftar Jadwal',
            'user' => $this->session->userdata('nama')
        ));
        $this->load->view('jadwal/daftar', $data);
        $this->load->view('_layout/foot');
        $this->load->view('jadwal/daftar_js');
        $this->load->view('_layout/closing');
    }

    public function laporan()
    {
        if (
            $this->session->userdata('akses') != 'a000000042'
            && $this->session->userdata('akses') != 'a000000004'
        ) {
            redirect('errorLayer/e_403');
        }

        $this->load->model('MUnit');

        $data['unit'] = $this->MUnit->listAll()->result();

        $this->load->view('_layout/head', array(
            'judul' => 'Laporan Kehadiran',
            'user' => $this->session->userdata('nama')
        ));
        $this->load->view('jadwal/laporan', $data);
        $this->load->view('_layout/foot');
        $this->load->view('jadwal/laporan_js');
        $this->load->view('_layout/closing');
    }

    public function laporanKyw()
    {
        if (
            $this->session->userdata('akses') != 'a000000042'
            && $this->session->userdata('akses') != 'a000000004'
        ) {
            redirect('errorLayer/e_403');
        }

        $this->load->view('_layout/head', array(
            'judul' => 'Laporan Kehadiran per Karyawan',
            'user' => $this->session->userdata('nama')
        ));
        $this->load->view('jadwal/laporan_kyw');
        $this->load->view('_layout/foot');
        $this->load->view('jadwal/laporan_kyw_js');
        $this->load->view('_layout/closing');
    }

    public function get($id)
    {
        header("Content-Type: application/json");
        $find = $this->MJadwal->get($id);
        echo json_encode($find->result());
    }

    public function listByUnit($id_unit, $bulan, $tahun)
    {
        header("Content-Type: application/json");
        $this->load->model('MKaryawan');
        $this->load->helper('timediff');

        $karyawan = $this->MKaryawan->listByUnit($id_unit);
        $data_karyawan = $karyawan->result();

        $jadwal = $this->MJadwal->listByUnit($id_unit, $bulan, $tahun);
        $data_jadwal = $jadwal->result();

        $jadwal_all = [];

        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, (int)$bulan, (int)$tahun);

        for ($i = 0; $i < sizeof($data_karyawan); $i++) {
            $karyawan_ = array(
                'fid' => $data_karyawan[$i]->FID,
                'nama' => $data_karyawan[$i]->Nama,
                'jadwal' => array(),
                'total_jam' => 0
            );
            array_push($jadwal_all, $karyawan_);

            for ($k = 1; $k <= $jumlah_hari; $k++) {
                $tanggal = str_pad((string)$k, 2, '0', STR_PAD_LEFT) . '/' . $bulan . '/' . $tahun;
                $nojadwal = '';
                $nama_jadwal = '';
                $durasi = 0;

                for ($j = 0; $j < sizeof($data_jadwal); $j++) {
                    if (
                        $tanggal == $data_jadwal[$j]->tanggal
                        && $jadwal_all[$i]['fid'] == $data_jadwal[$j]->fid
                    ) {
                        $nojadwal = $data_jadwal[$j]->nojadwal;
                        $nama_jadwal = $data_jadwal[$j]->nama_jadwal;
                        $durasi = getTimeDiff($data_jadwal[$j]->jam_masuk, $data_jadwal[$j]->jam_keluar);
                    }
                }

                $jadwal_ = array(
                    'tanggal' => $tanggal,
                    'nojadwal' => $nojadwal,
                    'nama_jadwal' => $nama_jadwal,
                    'durasi' => $durasi
                );

                array_push($jadwal_all[$i]['jadwal'], $jadwal_);
            }
        }
        echo json_encode($jadwal_all);
    }

    public function laporanPerUnit($id_unit, $bulan, $tahun)
    {
        // header("Content-Type: application/json");
        $this->load->model('MKaryawan');
        $this->load->model('MIzin');
        $this->load->helper('timediff');

        $karyawan = $this->MKaryawan->listByUnit($id_unit);
        $data_karyawan = $karyawan->result();

        $jadwal = $this->MJadwal->listByUnit($id_unit, $bulan, $tahun);
        $data_jadwal = $jadwal->result();

        $cuti = $this->MIzin->laporanPerUnit($id_unit, $bulan, $tahun);
        $data_cuti = $cuti->result();

        $laporan = $this->MJadwal->laporanPerUnit($id_unit, $bulan, $tahun);
        $data_laporan = $laporan->result();

        $kehadiran_all = [];

        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, (int)$bulan, (int)$tahun);

        for ($i = 0; $i < sizeof($data_karyawan); $i++) {
            $karyawan_ = array(
                'fid' => $data_karyawan[$i]->FID,
                'nama' => $data_karyawan[$i]->Nama,
                'jadwal' => array()
            );
            array_push($kehadiran_all, $karyawan_);

            for ($k = 1; $k <= $jumlah_hari; $k++) {
                $tanggal = str_pad((string)$k, 2, '0', STR_PAD_LEFT) . '/' . $bulan . '/' . $tahun;
                $nama_jadwal = '';
                $jam_masuk = '';

                for ($j = 0; $j < sizeof($data_jadwal); $j++) {
                    if (
                        $tanggal == $data_jadwal[$j]->tanggal
                        && $kehadiran_all[$i]['fid'] == $data_jadwal[$j]->fid
                    ) {
                        $nama_jadwal = $data_jadwal[$j]->nama_jadwal;
                        $jam_masuk = $data_jadwal[$j]->jam_masuk;
                    }
                }

                for ($l = 0; $l < sizeof($data_cuti); $l++) {
                    if (
                        $tanggal == $data_cuti[$l]->tglijin
                        && $kehadiran_all[$i]['fid'] == $data_cuti[$l]->fid
                    ) {
                        $nama_jadwal = 'Cuti';
                        $jam_masuk = 'C';
                    }
                }

                $jadwal_ = array(
                    'tanggal' => $tanggal,
                    'nama_jadwal' => $nama_jadwal,
                    'jam_masuk' => $jam_masuk
                );

                array_push($kehadiran_all[$i]['jadwal'], $jadwal_);
            }
        }

        for ($i = 0; $i < sizeof($data_karyawan); $i++) {
            $kehadiran_all[$i]['kehadiran'] = [];

            for ($k = 0; $k < sizeof($kehadiran_all[$i]['jadwal']); $k++) {
                $tanggal = $kehadiran_all[$i]['jadwal'][$k]['tanggal'];
                $jam_masuk = $kehadiran_all[$i]['jadwal'][$k]['jam_masuk'];
                $jam_absen = '';
                $lambat = 0;
                $potongan_lambat = 0;

                for ($l = 0; $l < sizeof($data_cuti); $l++) {
                    if (
                        $tanggal == $data_cuti[$l]->tglijin
                        && $kehadiran_all[$i]['fid'] == $data_cuti[$l]->fid
                    ) {
                        $jam_absen = '';
                        $lambat = 0;
                        $potongan_lambat = 8500;
                    }
                }

                for ($j = 0; $j < sizeof($data_laporan); $j++) {
                    if (
                        $tanggal == $data_laporan[$j]->tanggal_log
                        && $kehadiran_all[$i]['fid'] == $data_laporan[$j]->fid
                    ) {
                        $jam_absen = $data_laporan[$j]->jam_log;

                        if ($jam_absen != '' && $jam_masuk != '') {
                            $lambat_ = getTimeDiffNND($data_laporan[$j]->jam_log, $jam_masuk);

                            if ($lambat_ > 0) {
                                $lambat = $lambat_;
                            }
                        }
                    }
                }

                if ($kehadiran_all[$i]['jadwal'][$k]['nama_jadwal'] != '') {
                    if ($lambat >= 6 && $lambat < 11) {
                        $potongan_lambat = 2000;
                    } elseif ($lambat >= 11 && $lambat < 21) {
                        $potongan_lambat = 3000;
                    } elseif ($lambat >= 21 && $lambat < 61) {
                        $potongan_lambat = 4000;
                    } elseif ($lambat >= 61 && $lambat < 181) {
                        $potongan_lambat = 6000;
                    } elseif ($lambat >= 181) {
                        $potongan_lambat = 8500;
                    }

                    if ($jam_absen == '') {
                        $potongan_lambat = 8500;
                    }
                }

                $kehadiran_ = array(
                    'tanggal' => $tanggal,
                    'jam_masuk' => $jam_masuk,
                    'jam_absen' => $jam_absen,
                    'lambat' => $lambat,
                    'potongan_lambat' => $potongan_lambat
                );

                array_push($kehadiran_all[$i]['kehadiran'], $kehadiran_);
            }
        }
        echo json_encode($kehadiran_all);
    }

    public function laporanPerKaryawan($fid, $bulan, $tahun)
    {
        header("Content-Type: application/json");
        $this->load->model('MIzin');
        $this->load->helper('timediff');

        $jadwal = $this->MJadwal->listByKaryawan($fid, $bulan, $tahun);
        $data_jadwal = $jadwal->result();

        $cuti = $this->MIzin->laporanPerKaryawan($fid, $bulan, $tahun);
        $data_cuti = $cuti->result();

        $laporan = $this->MJadwal->laporanPerKaryawan($fid, $bulan, $tahun);
        $data_laporan = $laporan->result();

        $kehadiran = [];
        $kehadiran_ = [];

        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, (int)$bulan, (int)$tahun);

        for ($k = 1; $k <= $jumlah_hari; $k++) {
            $tanggal = str_pad((string)$k, 2, '0', STR_PAD_LEFT) . '/' . $bulan . '/' . $tahun;
            $nama_jadwal = '';
            $jam_masuk = '';

            for ($j = 0; $j < sizeof($data_jadwal); $j++) {
                if (
                    $tanggal == $data_jadwal[$j]->tanggal
                    && $data_jadwal[$j]->fid == $fid
                ) {
                    $nama_jadwal = $data_jadwal[$j]->nama_jadwal;
                    $jam_masuk = $data_jadwal[$j]->jam_masuk;
                }
            }

            for ($l = 0; $l < sizeof($data_cuti); $l++) {
                if (
                    $tanggal == $data_cuti[$l]->tglijin
                    && $data_cuti[$l]->fid == $fid
                ) {
                    $nama_jadwal = 'Cuti';
                    $jam_masuk = 'C';
                }
            }

            $jadwal_ = array(
                'tanggal' => $tanggal,
                'nama_jadwal' => $nama_jadwal,
                'jam_masuk' => $jam_masuk
            );

            array_push($kehadiran_, $jadwal_);
        }

        for ($k = 0; $k < sizeof($kehadiran_); $k++) {
            $tanggal = $kehadiran_[$k]['tanggal'];
            $jam_masuk = $kehadiran_[$k]['jam_masuk'];
            $jam_absen = '';
            $lambat = 0;
            $potongan_lambat = 0;

            for ($l = 0; $l < sizeof($data_cuti); $l++) {
                if (
                    $tanggal == $data_cuti[$l]->tglijin
                    && $data_cuti[$l]->fid == $fid
                ) {
                    $jam_absen = '';
                    $lambat = 0;
                    $potongan_lambat = 8500;
                }
            }

            for ($j = 0; $j < sizeof($data_laporan); $j++) {
                if (
                    $tanggal == $data_laporan[$j]->tanggal_log
                    && $data_laporan[$j]->fid == $fid
                ) {
                    $jam_absen = $data_laporan[$j]->jam_log;

                    if ($jam_absen != '' && $jam_masuk != '') {
                        $lambat_ = getTimeDiffNND($data_laporan[$j]->jam_log, $jam_masuk);

                        if ($lambat_ > 0) {
                            $lambat = $lambat_;
                        }
                    }
                }
            }

            if ($kehadiran_[$k]['nama_jadwal'] != '') {
                if ($lambat >= 6 && $lambat < 11) {
                    $potongan_lambat = 2000;
                } elseif ($lambat >= 11 && $lambat < 21) {
                    $potongan_lambat = 3000;
                } elseif ($lambat >= 21 && $lambat < 61) {
                    $potongan_lambat = 4000;
                } elseif ($lambat >= 61 && $lambat < 181) {
                    $potongan_lambat = 6000;
                } elseif ($lambat >= 181) {
                    $potongan_lambat = 8500;
                }

                if ($jam_absen == '') {
                    $potongan_lambat = 8500;
                }
            }

            $kehadiran__ = array(
                'tanggal' => $tanggal,
                'jam_masuk' => $jam_masuk,
                'jam_absen' => $jam_absen,
                'lambat' => $lambat,
                'potongan_lambat' => $potongan_lambat
            );

            array_push($kehadiran, $kehadiran__);
        }
        echo json_encode($kehadiran);
    }

    public function save()
    {
        header("Content-Type: application/json");

        $data_post = trim(file_get_contents('php://input'));
        $decode = json_decode($data_post, true);

        $data_tanggal_delete = [];
        $data_fid_delete = [];
        $data_all = [];
        foreach ($decode as $d) {
            for ($i = 0; $i < sizeof($d['jadwal']); $i++) {
                array_push($data_all,  array(
                    'fid' => $d['fid'],
                    'tanggal' => $d['jadwal'][$i]['tanggal'],
                    'nojadwal' => $d['jadwal'][$i]['nojadwal']
                ));

                array_push($data_tanggal_delete, $d['jadwal'][$i]['tanggal']);
            }
            array_push($data_fid_delete, $d['fid']);
        }

        $data = array(
            'tgl_to_delete' => array_unique($data_tanggal_delete),
            'fid_to_delete' => array_unique($data_fid_delete),
            'jadwal_to_insert' => $data_all
        );
        $save = $this->MJadwal->save($data);

        $result = new stdClass();
        if ($save) {
            $result->status = 'save-ok';
        } else {
            $result->status = 'save-err';
        }

        echo json_encode($result);
    }

    function cetak()
    {
        $data_post = trim(file_get_contents('php://input'));
        $decode = json_decode($data_post, true);

        $data['bulan'] = $decode['bulan'];
        $data['tahun'] = $decode['tahun'];
        $data['unit'] = $decode['unit'];
        $data['jadwal'] = $decode['jadwal'];
        $data['keterangan'] = $decode['keterangan'];

        $this->load->view('jadwal/cetak_excel', $data);
    }

    function cetaklap()
    {
        $data_post = trim(file_get_contents('php://input'));
        $decode = json_decode($data_post, true);

        $data['bulan'] = $decode['bulan'];
        $data['tahun'] = $decode['tahun'];
        $data['unit'] = $decode['unit'];
        $data['jadwal'] = $decode['jadwal'];
        $data['keterangan'] = $decode['keterangan'];

        $this->load->view('jadwal/cetak_excel_lap', $data);
    }

    function cetaklapkar()
    {
        $data_post = trim(file_get_contents('php://input'));
        $decode = json_decode($data_post, true);

        $data['bulan'] = $decode['bulan'];
        $data['tahun'] = $decode['tahun'];
        $data['nama'] = $decode['nama'];
        $data['unit'] = $decode['unit'];
        $data['jadwal'] = $decode['jadwal'];

        $this->load->view('jadwal/cetak_excel_lap_kar', $data);
    }
}
