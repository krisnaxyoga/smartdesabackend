<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class LogInventaris extends Model
{
    use Village;

    protected $table = "inventaris_log";

    protected $fillable = [
        'desa_id',
        'detail_inventaris_id',
        'kondisi_lama',
        'kondisi_baru',
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
