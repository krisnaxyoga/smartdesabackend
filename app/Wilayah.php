<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Village;

class Wilayah extends Model
{
    use Village;

    protected $table = 'wilayah';
    protected $fillable = [
        'rt','rw','dusun','id_kepala','lat','lng','zoom','map_tipe','coordinate'
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

    public function kadus()
    {
        return $this->hasOne('App\KepalaDusun','dusun_id');
    }
}
