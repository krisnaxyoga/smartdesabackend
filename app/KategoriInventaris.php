<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// use App\Traits\Village;

class KategoriInventaris extends Model
{
    // use Village;

    protected $table = "kategori_inventaris";

    protected $fillable = [
        'golongan',
        'bidang',
        'kelompok',
        'sub_kelompok',
        'sub_sub_kelompok',
        'nama_kategori',
    ];

    /**
     *  Setup model event hooks
     */
    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->desa_id = auth()->user()->desa_id;
    //     });
    // }

    public function kategori()
    {
        return $this->belongsTo('App\Inventaris', 'kategori_id');
    }
}
