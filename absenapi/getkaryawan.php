<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include 'redir.php';
require_once('conn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $konten = trim(file_get_contents("php://input"));
    $decode = json_decode($konten, true);

    $fid = $decode['fid'];

    $response = array();
    $query_karyawan = $connect->query("SELECT fid, nama, jabatan, namaunit
		FROM hr_staff_info aa
        LEFT JOIN hr_unit bb ON aa.dept_name = bb.idunit
        WHERE fid = " . $fid);
    $row_karyawan = $query_karyawan->num_rows;
    $data_karyawan = $query_karyawan->fetch_assoc();
    if ($row_karyawan > 0) {
        $data = new stdClass();

        $data->nama = $data_karyawan['nama'];
        $data->jabatan = $data_karyawan['jabatan'];
        $data->namaunit = $data_karyawan['namaunit'];

        $response = array(
            'data' =>  $data,
            'metadata' => array(
                'message' => 'Ok',
                'code' => 200
            )
        );
    } else {
        $response = array(
            'metadata' => array(
                'message' => 'Tidak ditemukan data',
                'code' => 401
            )
        );
    }

    echo json_encode($response);
}
