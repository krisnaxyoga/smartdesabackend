<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPendudukPendatang extends Model
{
    protected $table = 'detail_penduduk_pendatang';
    protected $fillable = [
        'duktang_id',
        'nik',
        'nama',
        'sex_id',
        'tanggallahir',
        'status_kawin_id',
        'pendidikan_id',
        'status_keluarga_id',
        'keterangan'
    ];

    protected $appends = ['umur'];

    public function duktang()
    {
        return $this->belongsTo('App\PendudukPendatang', 'duktang_id');
    }

    public function jenisKelamin()
    {
        return $this->belongsTo('App\PendudukSex', 'sex_id');
    }

    public function status_kawin()
    {
        return $this->belongsTo('App\PendudukKawin', 'status_kawin_id');
    }

    public function hubungan()
    {
        return $this->belongsTo('App\PendudukHubungan', 'status_keluarga_id');
    }
    public function pendidikan()
    {
        return $this->belongsTo('App\PendudukPendidikan', 'pendidikan_id');
    }

    public function getUmurAttribute()
    {
        return round((time() - strtotime($this->tanggallahir)) / (3600 * 24 * 365.25));
        // return (int)(date('Y')) - (int)(date('Y',strtotime($this->tanggallahir)));
    }

}
