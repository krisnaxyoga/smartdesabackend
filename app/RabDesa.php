<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class RabDesa extends Model
{
    use Village;

    protected $table = "rab";

    protected $fillable = [
        'id',
        'desa_id',
        'no_rab',
        'id_kegiatan'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $model->desa_id = auth()->user()->desa_id;
        });
    }
}
