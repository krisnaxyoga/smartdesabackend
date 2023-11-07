<?php

require('koneksi.php');

$id = $_POST['id'];

$select = "SELECT * FROM `pengajuan_surat` WHERE `penduduk_id` = '$id' AND `status` = 'ACCEPTED'";

// $select = "SELECT * FROM `pengajuan_surat`";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$response["kode"] = 1;
	$response["message"] = "Data Tersedia";
	$response["data"] = array();

	while($get = mysqli_fetch_object($result)){
		$F["id"] = $get->id;
		$F["jenis_acara"] = $get->jenis_acara;
		$F["keperluan"] = $get->keperluan;
		$F["tanggal_pengajuan"] = $get->tanggal_pengajuan;
		$F["track_number"] = $get->track_number;

		array_push($response["data"], $F);
	}
}
else{
	$response["kode"] = 0;
	$response["message"] = "Data Tidak Tersedia";
}

echo json_encode($response);
mysqli_close($koneksi);