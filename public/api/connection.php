<?php

$connection = null;

try{
    //Config
    $host = "localhost";
    $username = "u8665933_kurungannyawa";
    $password = "@kurungannyawa123";
    $dbname = "u8665933_kurungannyawa_main";

    //Connect
    $database = "mysql:dbname=$dbname;host=$host";
    $connection = new PDO($database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // if($connection){
    //     echo "Koneksi Berhasil";
    // } else {
    //     echo "Gagal gan";
    // }


} catch (PDOException $e){
    echo "Error ! " . $e->getMessage();
    die;
}

?>