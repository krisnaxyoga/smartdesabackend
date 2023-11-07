<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class RkpSumberDana extends Model
{
    use Village;

    protected $table = 'rkp_sumber_dana';
    protected $fillable = [
       'nama',
       'dana'
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
