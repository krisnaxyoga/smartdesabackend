<?php

require('koneksi.php');

//sesuai kode dari id
$id = 4;

$select = "SELECT * FROM `desa` WHERE `id` = '$id'";

$result= mysqli_query($koneksi,$select);
$cek = mysqli_affected_rows($koneksi);

if($cek > 0){
	$respon["data"] = array();

	while($get = mysqli_fetch_object($result)){
		$F["akronim"] = $get->akronim;

		array_push($respon["data"], $F);
	}
}
else{

}
echo json_encode($respon);
mysqli_close($koneksi);