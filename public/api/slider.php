<?php

require('koneksi.php');

$select = "SELECT * FROM `slider`";


$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$response["data"] = array();

	while($get = mysqli_fetch_object($result)){
		$F["id"] = $get->id;
		$F["desa_id"] = $get->desa_id;
		$F["title"] = $get->title;
		$F["gambar"] = $get->gambar;
		$F["created_at"] = $get->created_at;
		$F["updated_at"] = $get->updated_at;

		array_push($response["data"], $F);
	}
}
else{
}

echo json_encode($response);
mysqli_close($koneksi);