<?php

require('koneksi.php');

$select = "SELECT * FROM `pengaduan_categories`";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$response["kode"] = 1;
	$response["data"] = array();

	while($get = mysqli_fetch_object($result)){
		$F["id"] = $get->id;
		$F["desa_id"] = $get->desa_id;
		$F["name"] = $get->name;
		$F["photo"] = $get->photo;
		$F["created_at"] = $get->created_at;
		$F["updated_at"] = $get->updated_at;

		array_push($response["data"], $F);
	}
}
else{
	$response["kode"] = 0;
}

echo json_encode($response);
mysqli_close($koneksi);