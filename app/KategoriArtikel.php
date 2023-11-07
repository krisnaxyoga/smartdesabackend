<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Village;
class KategoriArtikel extends Model
{
    //
        use Village;
        protected $table = "kategori_artikel";

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
    protected $fillable = [
        'nama',
        'status',
    ];
}
