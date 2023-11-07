<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Desa extends Model
{
    protected $table = 'desa';
    protected $fillable = [
        'nama_desa',
        'kode_desa',
        'nama_kepala_desa',
        'nip_kepala_desa',
        'kode_pos',
        'kode_village',
        'nama_kecamatan',
        'kode_kecamatan',
        'nama_kepala_camat',
        'nip_kepala_camat',
        'nama_kabupaten',
        'kode_kabupaten',
        'nama_propinsi',
        'kode_propinsi',
        'logo',
        'lat',
        'lng',
        'zoom',
        'map_tipe',
        'path',
        'alamat_kantor',
        'g_analytic',
        'email_desa',
        'telepon',
        'website',
        'akronim'
    ];

    public function barang() {
        return $this->hasMany('App\Barang', 'desa_id');
    }

    public function kategori_barang() {
        return $this->hasMany('App\KategoriBarang', 'desa_id');
    }
}
