<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class Cctv extends Model
{
    use Village;
    protected $table = "cctv";

    protected $fillable = [
        'desa_id',
        'nama_cctv',
        'link',
        'lat',
        'lng',
        'keterangan'
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
