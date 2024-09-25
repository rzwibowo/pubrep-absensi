<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
date_default_timezone_set('Asia/Jakarta');

include 'redir.php';
require_once('conn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $konten = trim(file_get_contents("php://input"));
    $decode = json_decode($konten, true);
    $response = array();

    $hari_ini = date('d/m/Y');
    $jam_sekarang = date('H:i:s');
    $hari_jam = $hari_ini . ' ' . $jam_sekarang;

    $fid = $decode['fid'];
    $tipe = (int) $decode['tipe'] == 0 ? 'in' : 'out';
    $verifikasi = 'mobile';

    // get nama_karyawan
    $query_karyawan = $connect->query("SELECT nama
            FROM hr_staff_info
            WHERE fid = " . $fid);
    $row_karyawan = $query_karyawan->num_rows;
    $data_karyawan = $query_karyawan->fetch_assoc();
    $nama_karyawan = $data_karyawan["nama"];

    if ($row_karyawan == 0) {
        $msg = 'Karyawan tidak ditemukan';
        $response = array(
            'metadata' => array(
                'message' => $msg,
                'code' => 401
            )
        );
    } else {
        $q_insert_presensi = $connect->query("INSERT INTO ta_log
                (mach_id, fid, nama_staff, verifikasi, in_out, tanggal_log, jam_log, datetime)
                VALUES('-1', " . $fid . ", '" . $nama_karyawan . "', '" . $verifikasi . "', '" . $tipe . "',
                     '" . $hari_ini . "', '" . $jam_sekarang . "', '" . $hari_jam . "')");

        if ($q_insert_presensi) {
            $response = array(
                'metadata' => array(
                    'message' => 'Berhasil presensi.',
                    'code' => 200
                )
            );
        } else {
            $response = array(
                'metadata' => array(
                    'message' => "Gagal presensi.",
                    'code' => 401
                )
            );
        }
    }
    echo json_encode($response);
}
