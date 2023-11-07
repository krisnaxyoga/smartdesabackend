<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class Inventaris extends Model
{
    use Village;

    protected $table = 'inventaris';

    protected $fillable = [
        'desa_id',
        'kategori_id',
        'kode_barang',
        'bidang_id',
        'tahun_perolehan',
        'stock',
        'harga_perolehan',
        'sumber_inventaris_id',
        'nama_inventaris',
        'merk',
        'no_sertifikat',
        'bahan',
        'unit_id',
        'keterangan',
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

    public function kategori()
    {
        return $this->belongsTo('App\KategoriInventaris', 'kategori_id');
    }
}
