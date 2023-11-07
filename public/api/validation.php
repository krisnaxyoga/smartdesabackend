<?php

include 'connection.php';

if($_POST){

    //Data
    $no_kk = $_POST['no_kk'] ?? '';
    $nik_kepala = $_POST['nik_kepala'] ?? '';

    $response = []; //Data Response

    //Cek NIK didalam databse
    $userQuery = $connection->prepare("SELECT * FROM keluarga where no_kk = ?");
    $userQuery->execute(array($no_kk));
    $query = $userQuery->fetch();

    if($userQuery->rowCount() == 0){
        $response['error'] = true;
        $response['message'] = "No.KK Tidak Terdaftar";
    } else {
        // Ambil Tanggal di db

        $passwordDB = $query['nik_kepala'];

        if(strcmp($nik_kepala,($passwordDB)) === 0){
            $response['error'] = false;
            $response['message'] = "Data Ditemukan";
            $response['data'] = [
                'id' => $query['id'],
                'desa_id' => $query['desa_id'],
                'no_kk' => $query['no_kk'],
                'nik_kepala' => $query['nik_kepala']
            ];
        } else {
            $response['error'] = true;
            $response['message'] = "NIK Kepala Keluarga Tidak Cocok";
        }
    }

    //Jadikan data JSON
    $json = json_encode($response, JSON_PRETTY_PRINT);

    //Print
    echo $json;

}