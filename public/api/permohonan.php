<?php

include_once('koneksi.php');

$desa_id = $_POST['desa_id'];
$dusun_id = $_POST['dusun_id'];
$keperluan = $_POST['keperluan'];
$penduduk_id = $_POST['penduduk_id'];
$jenis_surat_id = $_POST['jenis_surat_id'];
$jenis_acara = $_POST['jenis_acara'];
$status = "ACCEPTED";
$is_mobile = true;
$tanggal_pengajuan = date("Y-m-d");
$created_at = date('Y-m-d H:i:s');
$kode_surat = $_POST['kode_surat'];
$nmb_rndm = rand(1000, 9999);
$berlaku_dari = $_POST['berlaku_dari'];
$berlaku_hingga = $_POST['berlaku_hingga'];
$nama_pasangan = $_POST['nama_pasangan'];
$tahun_kawin = $_POST['tahun_kawin'];
$lokasi_kawin = $_POST['lokasi_kawin'];
$pernyataan_sebagai = $_POST['pernyataan_sebagai'];
$nama_usaha = $_POST['nama_usaha'];
$jenis_usaha = $_POST['jenis_usaha'];
$alamat_usaha = $_POST['alamat_usaha'];
$no_kk = $_POST['no_kk'];

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

$track = "PMH/$java/$kode_surat/".date('m'). '/' .$nmb_rndm;

$response = array();

$insert = "INSERT INTO `pengajuan_surat`(`id`, `desa_id`, `dusun_id`, `keperluan`, `keterangan`, `penduduk_id`, `jenis_surat_id`, `nomor_surat`, `jenis_acara`, `berlaku_dari`, `berlaku_sampai`, `staff_id`, `staff_sebagai_id`, `no_surat_pengantar`, `status`, `is_mobile`, `tanggal_pengajuan`, `tanggal_verifikasi`, `tanggal_cetak`, `created_at`, `updated_at`, `deleted_at`, `remark_kadus`, `track_number`, `nama_usaha`, `alamat_usaha`, `jenis_usaha`, `nama_pasangan`, `tahun_kawin`, `lokasi_kawin`, `pernyataan_status`, `pindah_desa`, `pindah_kec`, `pindah_kab`, `pindah_prov`, `tanggal_pindah`, `tanggal_kk`, `no_kk`, `tahun_menetap`, `nama_dusun`, `nama_desa`, `nama_kecamatan`, `nama_kabupaten`, `nama_provinsi`, `tanggal_meninggal`, `lokasi_meninggal`, `penyebab_meninggal`, `nama_pelapor`, `nik_pelapor`, `hubungan_pelapor`) VALUES (NULL,'$desa_id','$dusun_id','$keperluan',NULL,'$penduduk_id','$jenis_surat_id',NULL,'$jenis_acara','$berlaku_dari','$berlaku_hingga',NULL,NULL,NULL,'$status','$is_mobile','$tanggal_pengajuan',NULL,NULL,'$created_at','$created_at',NULL,NULL,'$track','$nama_usaha','$alamat_usaha','$jenis_usaha','$nama_pasangan','$tahun_kawin','$lokasi_kawin','$pernyataan_sebagai',NULL,NULL,NULL,NULL,NULL,NULL,'$no_kk',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";

	$exeinsert = mysqli_query($koneksi, $insert);
	if($exeinsert){
		$response['status']=true;
		$response['message']="Permohonan Surat Masuk";
	}else{
		$response['status']=false;
		$response['message']="Permohonan Surat Gagal";
	}
	echo json_encode($response);
	
?>