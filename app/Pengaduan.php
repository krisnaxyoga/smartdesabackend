<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{

    public $table = 'pengaduans';

    public $fillable = [
    'desa_id',
    'penduduk_id',
    'pengaduan_category_id',
    'no_pengaduan',
    'title',
    'content',
    'lat',
    'lng',
    'user_target',
    'user_id',
    'rating',
    'status',
    'start_date',
    'end_date',
    'photo'
    ];

    protected $appends = ['disposisi'];


    public function pelapor()
    {
        return $this->belongsTo('App\Penduduk', 'penduduk_id');
    }

    public function category()
    {
        return $this->belongsTo('App\PengaduanCategories', 'pengaduan_category_id');
    }

    public function comments()
    {
        return $this->hasMany('App\PengaduanComment', 'pengaduan_id');
    }

    public function desapamong()
    {
        return $this->belongsTo('App\DesaPamong', 'user_id');
    }

    public function kadus()
    {
        return $this->belongsTo('App\KepalaDusun', 'user_id');
    }

    public function getDisposisiAttribute()
    {
        if ($this->user_target == "desa" || $this->user_target == "DESA") {
            $data = $this->desapamong()->select('pamong_nama as nama','jabatan')->first();
            return $data->nama.' ( '.$data->jabatan.' )';
        } elseif($this->user_target == "kadus" || $this->user_target == "KADUS") {
            $data = $this->kadus()->with('dusun')->first();
            return $data->name.' ( Kepala '.$data->dusun->dusun.' )';
        } else{
            return "-";
        }
    }
}
