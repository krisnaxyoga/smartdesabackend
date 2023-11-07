<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = [
        'name',
        'kode_barang',
        'harga',
        'kategori_barang_id'
    ];

    public function kategori_barang() {
        return $this->belongsTo('App\KategoriBarang', 'kategori_barang_id');
    }

    public function uraian()
    {
        return $this->hasMany('App\UraianRab', 'barang_id', 'id')->where('id_rab','!=', null);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->desa_id = auth()->user()->desa_id;
        });
    }
}
