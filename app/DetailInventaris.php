<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class DetailInventaris extends Model
{
    use Village;

    protected $table = "detail_inventaris";

    protected $fillable = [
        'desa_id',
        'inventaris_id',
        'kode_register',
        'kondisi',
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
