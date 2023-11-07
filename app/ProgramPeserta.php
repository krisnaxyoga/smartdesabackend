<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProgramPeserta extends Model
{
    protected $table = 'program_peserta';
    protected $fillable = [
        'peserta',
        'program_id',
        'sasaran' ,
        'no_id_kartu',
        'kartu_nik' ,
        'kartu_nama' ,
        'kartu_tempat_lahir' ,
        'kartu_tanggal_lahir' ,
        'kartu_alamat' ,
        'kartu_peserta' ,
      
    ];

    protected $appends = [
        'data_peserta'
    ];

    public function program()
    {
        return $this->belongsTo('App\Program','program_id');
    }


    public function keluarga()
    {
        return $this->belongsTo('App\Keluarga','peserta');
    }

    public function penduduk()
    {
        return $this->belongsTo('App\Penduduk','peserta');
    }

    public function getDataPesertaAttribute()
    {
        if($this->sasaran == 2) {
            return $this->keluarga;
        } else {
            return $this->penduduk;
        }
    }
}
