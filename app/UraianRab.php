<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class UraianRab extends Model
{
    use Village;

    protected $table = "uraian_rab";

    protected $fillable = [
        'id',
        'id_rab',
        'nama_uraian',
        'kategori_uraian',
        'barang_id',
        'volume',
        'satuan',
        'harga_satuan',
        'jumlah_total',
        'keterangan'
    ];

    public function barang(){
        return $this->belongsTo('App\Barang', 'barang_id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $model->desa_id = auth()->user()->desa_id;
        });
    }
}
