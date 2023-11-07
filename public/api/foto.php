<?php

include_once('koneksi.php');

$id = $_POST['id'];
$foto = base64_decode($_POST['foto']);

$nmb_rndm = rand(1000, 9999);
$tgl = date("Y-m-d");

$nama_profil = "Penduduk-".$tgl.$nmb_rndm.$id.".jpeg";

$response = array();

$update = "UPDATE `penduduk` SET `foto` = '$nama_profil' WHERE `penduduk`.`id` = '$id'";

$direktori_foto = 'profil/'.$nama_profil;

if(file_put_contents($direktori_foto, $foto)){
	$exeinsert = mysqli_query($koneksi, $update);
	if($exeinsert){
		$response['error']=true;
		$response['message']="Foto Berhasil Dirubah";
	}else{
		$response['error']=false;
		$response['message']="Foto Gagal Dirubah";
	}
}else{
		$response['error']=false;
		$response['message']="Gagal Upload Foto";
	}
	echo json_encode($response);
	
?>