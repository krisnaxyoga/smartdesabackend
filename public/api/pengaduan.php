<?php

include_once('koneksi.php');

$desa_id = $_POST['desa_id'];
$penduduk_id = $_POST['penduduk_id'];
$pengaduan_category_id = $_POST['pengaduan_category_id'];
// $photo = base64_decode($_POST['photo']);

//Upload Foto
$nmb_rndm = rand(1000, 9999);
// $nama_photo = "Pengaduan-".$nmb_rndm.".jpeg";
// $direktori_foto = 'uploads/'.$nama_photo;


$tahun = date('Y');
$sequence_no = sprintf("%04s", $id);

$title = $_POST['title'];
$content = $_POST['content'];
$status = "PUBLISH";
$start_date = date("Y-m-d");
$created_at = date('Y-m-d H:i:s');

$select = "SELECT `akronim` FROM `desa` WHERE `id` = '$desa_id'";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $java = $row["akronim"];
  }
} else {
  $java = null;
}

$no_pengaduan = $nmb_rndm . '/' . 'ADUAN' . '/' . $java . '/' . $tahun;
$response = array();

$insert = "INSERT INTO `pengaduans`(`id`, `desa_id`,`penduduk_id`, `pengaduan_category_id`, `no_pengaduan`, `title`, `content`, `lat`, `lng`, `user_target`, `user_id`, `rating`, `status`, `start_date`, `end_date`, `photo`, `created_at`, `updated_at`) VALUES (NULL,'$desa_id','$penduduk_id','$pengaduan_category_id','$no_pengaduan','$title','$content',NULL,NULL,NULL,NULL,NULL,'$status','$start_date',NULL,NULL,'$created_at',NULL)";

	$exeinsert = mysqli_query($koneksi, $insert);
	if($exeinsert){
		$response['status']=true;
		$response['message']="Mengirim Pengaduan Sukses";
	}else{
		$response['status']=false;
		$response['message']="Mengirim Pengaduan Gagal";
	}
	echo json_encode($response);
	
?>