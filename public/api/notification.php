<?php

require('koneksi.php');

$select = "SELECT * FROM `notifications` WHERE `type` = 'ANNOUNCEMENT'";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$response["kode"] = 1;
	$response["data"] = array();

	while($get = mysqli_fetch_object($result)){
		$F["id"] = $get->id;
		$F["desa_id"] = $get->desa_id;
		$F["title"] = $get->title;
		$F["description"] = $get->description;
		$F["ref_id"] = $get->ref_id;
		$F["ref_type"] = $get->ref_type;
		$F["photo"] = $get->photo;
		$F["created_at"] = $get->created_at;
		$F["updated_at"] = $get->updated_at;
		$F["type"] = $get->type;

		array_push($response["data"], $F);
	}
}
else{
	$response["kode"] = 0;
}

echo json_encode($response);
mysqli_close($koneksi);