<?php

require('koneksi.php');

$id = $_POST['id'];
$keyword = $_POST['keyword'];

$select = "SELECT * FROM `pengajuan_surat` WHERE `penduduk_id` = '$id' AND `status` = 'GENERATED' AND `tanggal_cetak` LIKE '%$keyword%'";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$response["kode"] = 1;
	$response["message"] = "Data Tersedia";
	$response["data"] = array();

	while($get = mysqli_fetch_object($result)){
		$F["id"] = $get->id;
		$F["track_number"] = $get->track_number;
		$F["nomor_surat"] = $get->nomor_surat;
		$F["jenis_acara"] = $get->jenis_acara;
		$F["keperluan"] = $get->keperluan;
		$F["tanggal_cetak"] = $get->tanggal_cetak;

		array_push($response["data"], $F);
	}
}
else{
	$response["kode"] = 0;
	$response["message"] = "Data Tidak Tersedia";
}

echo json_encode($response);
mysqli_close($koneksi);