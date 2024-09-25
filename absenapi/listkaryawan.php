<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include 'redir.php';
require_once('conn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = array();
	$query_karyawan= $connect->query("SELECT fid, nama, jabatan, namaunit
		FROM hr_staff_info aa
		LEFT JOIN hr_unit bb ON aa.dept_name = bb.idunit");
	$row_karyawan = $query_karyawan->num_rows;
	if ($row_karyawan > 0) {
		$list = array();
		while ($data_karyawan = $query_karyawan->fetch_assoc()) {
			array_push($list,  array(
				'fid' => (int)$data_karyawan['fid'],
				'nama' => $data_karyawan['nama'],
				'jabatan' => $data_karyawan['jabatan'],
				'namaunit' => $data_karyawan['namaunit']
			));
		}
		
		$response = array(
			'data' =>  $list,
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
?>