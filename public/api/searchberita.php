<?php

require('koneksi.php');

$keyword = $_POST['keyword'];

$select = "SELECT * FROM `artikel` WHERE `judul` LIKE '%$keyword%' OR `konten` LIKE '%$keyword%' OR `type` LIKE '%$keyword%' ";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$response["kode"] = 1;
	$response["data"] = array();

	while($get = mysqli_fetch_object($result)){
		$F["id"] = $get->id;
		$F["judul"] = $get->judul;
		$F["created_at"] = $get->created_at;
		$F["updated_at"] = $get->updated_at;
		$F["konten"] = strip_tags($get->konten);
		$F["slug"] = $get->slug;
		$F["type"] = $get->type;
		$F["gambar"] = $get->gambar;

		array_push($response["data"], $F);
	}
}
else{
	$response["kode"] = 0;
}

echo json_encode($response);
mysqli_close($koneksi);