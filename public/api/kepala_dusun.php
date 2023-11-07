<?php

require('koneksi.php');

$dusun_id = $_POST['dusun_id'];

$select = "SELECT * FROM `kepala_dusun` WHERE `dusun_id`='$dusun_id'";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$response["kode"] = 1;
	$response["data"] = array();

	while($get = mysqli_fetch_object($result)){
		$F["id"] = $get->id;
		$F["name"] = $get->name;
		$F["dusun_id"] = $get->dusun_id;
		$F["created_at"] = $get->created_at;
		$F["updated_at"] = $get->updated_at;
		$F["phone"] = $get->phone;
		$F["photo"] = $get->photo;

		array_push($response["data"], $F);
	}
}
else{
	$response["kode"] = 0;
}

echo json_encode($response);
mysqli_close($koneksi);