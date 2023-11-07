<?php

require('koneksi.php');

$id = $_POST['id'];

$select = "SELECT * FROM `pengaduans` WHERE `no_pengaduan` = '$id'";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$response["kode"] = 1;
	$response["data"] = array();

	while($get = mysqli_fetch_object($result)){
		$F["no_pengaduan"] = $get->id;
		$F["content"] = $get->content;

		array_push($response["data"], $F);
	}
}
else{
	$response["kode"] = 0;
}

echo json_encode($response);
mysqli_close($koneksi);