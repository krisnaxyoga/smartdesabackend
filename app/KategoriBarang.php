<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $table = 'kategori_barang';
    protected $fillable = [
        'id',
        'name'
    ];

    public function barang() {
        return $this->hasMany('App\Barang', 'kategori_barang_id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->desa_id = auth()->user()->desa_id;
        });
    }
}
