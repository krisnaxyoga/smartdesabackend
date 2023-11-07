<?php

include_once('koneksi.php');

$id = $_POST['id'];
$is_mobile = false;

$update = "UPDATE `pengajuan_surat` SET `is_mobile`= '$is_mobile' WHERE `id` = '$id'";

	$exeinsert = mysqli_query($koneksi, $update);
	if($exeinsert){
		$response['status']=true;
		$response['message']="Konfirmasi Berhasil";
	}else{
		$response['status']=false;
		$response['message']="Kesalahan Server";
	}
	echo json_encode($response);
	
?>