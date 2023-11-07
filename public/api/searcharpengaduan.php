<?php

require('koneksi.php');

$penduduk_id = $_POST['penduduk_id'];
$keyword = $_POST['keyword'];

$select = "SELECT * FROM `pengaduans` INNER JOIN `pengaduan_comments` ON pengaduan_comments.pengaduan_id = pengaduans.id WHERE `penduduk_id` = '$penduduk_id'  AND `start_date` LIKE '%$keyword%'";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$response["kode"] = 1;
	$response["data"] = array();

	while($get = mysqli_fetch_object($result)){
        $F["pengaduan_id"] = $get->pengaduan_id;
        $F["user_type"] = $get->user_type;
        $F["user_id"] = $get->user_id;
        $F["content"] = $get->content;
		$F["photo"] = $get->photo;
		$F["created_at"] = $get->created_at;
		$F["updated_at"] = $get->updated_at;
		$F["id"] = $get->id;
		$F["user_id"] = $get->user_id;
		$F["penduduk_id"] = $get->penduduk_id;
		$F["pengaduan_category_id"] = $get->pengaduan_category_id;
		$F["no_pengaduan"] = $get->no_pengaduan;
		$F["title"] = $get->title;
		$F["content2"] = $get->content;
		$F["lat"] = $get->lat;
		$F["lng"] = $get->lng;
		$F["user_id2"] = $get->user_id;
		$F["rating"] = $get->rating;
		$F["status"] = $get->status;
		$F["start_date"] = $get->start_date;
		$F["end_date"] = $get->end_date;
		$F["photo2"] = $get->photo;
		$F["created_at2"] = $get->created_at;
        
		array_push($response["data"], $F);
	}
}
else{
	$response["kode"] = 0;
}

echo json_encode($response);
mysqli_close($koneksi);