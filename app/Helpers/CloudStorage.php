<?php
namespace App\Helpers;

use OSS\OssClient;
use OSS\Core\OssException;
use Illuminate\Support\Facades\App;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
class CloudStorage
{
    /**
     * Method for uploading object to the storage.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @return mixed
     */
    public static function upload($file)
    {

        //JIKA FILE TERSEDIA
        //MAKA KITA GET FILENYA
        //BUAT CUSTOM NAME YANG DIINGINKAN, DIMANA FORMATNYA KALI INI ADALH EMAIL + TIME DAN MENGGUNAKAN ORIGINAL EXTENSION
        $filename = '-' . time() . '.' . $file->getClientOriginalExtension();
        //UPLOAD MENGGUNAKAN CONFIG S3, DENGAN FILE YANG DIMASUKKAN KE DALAM FOLDER IMAGES
        //SECARA OTOMATIS AMAZON AKAN MEMBUAT FOLDERNYA JIKA BELUM ADA
        $url = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/desa"."/" .$filename;
        Storage::disk('s3')->put('desa/' . $filename, file_get_contents($file), 'public');
        //https://glsdesa.s3-ap-southeast-1.amazonaws.com/images/-1607082298.jpg
        //SIMPAN INFORMASI USER KE DATABASE
        //DAN profile YANG DISIMPAN HANYALAH FILENAME-NYA SAJA
        //REDIRECT KE HALAMAN YANG SAMA DAN BERIKAN NOTIFIKASI
        return $url;
    }
}
