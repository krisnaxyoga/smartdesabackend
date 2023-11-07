<?php

require('koneksi.php');

$select = "SELECT * FROM `pengaduan_comments`";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$response["kode"] = 1;
	$response["data"] = array();

	while($get = mysqli_fetch_object($result)){
		$F["id"] = $get->id;
		$F["desa_id"] = $get->desa_id;
		$F["pengaduan_id"] = $get->pengaduan_id;
		$F["user_type"] = $get->user_type;
		$F["user_id"] = $get->user_id;
		$F["content"] = $get->content;
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