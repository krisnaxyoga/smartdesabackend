<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class RkpDesa extends Model
{
    use Village;

    protected $table = 'rkp_desa';

    protected $fillable = [
        'id',
        'bidang_id',
        'desa_id',
        'status_rkp',
        'tahun'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $model->desa_id = auth()->user()->desa_id;
        });
    }
}
