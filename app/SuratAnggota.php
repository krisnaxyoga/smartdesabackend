<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratAnggota extends Model
{
    //
    protected $table = 'surat_anggota';    

    protected $fillable = [
        'penduduk_id',
        'nama',
        'jenis_kelamin',
        'umur',
        'status',
        'pendidikan',
        'ktp',
        'pengajuan_surat_id',
        'keterangan',
    ];

    public function penduduk()
    {
        return $this->belongsTo('App\Penduduk','penduduk_id');
    }

    public function pengajuanSurat()
    {
        return $this->belongsTo('App\PengajuanSurat','pengajuan_surat_id');
    }
    
}
