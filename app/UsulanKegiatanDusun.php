<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class UsulanKegiatanDusun extends Model
{
    use Village;

    protected $table = "kegiatan_eplanning";
    protected $fillable = [
        'desa_id',
        'wilayah_id',
        'usulan_dusun_id',
        'nama_kegiatan',
        'lokasi',
        'volume',
        'satuan',
        'penerima_lk',
        'penerima_pr',
        'penerima_artm',
        'status'
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->desa_id = auth()->user()->desa_id;
        });
    }
}
