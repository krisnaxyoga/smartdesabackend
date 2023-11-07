<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Village;

class PengaduanCategories extends Model
{
    use Village;

    public $table = 'pengaduan_categories';

    public $fillable = [
        'name',
        'photo'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->desa_id = auth()->user()->desa_id;
        });
    }

    public function categories()
    {
        return $this->hasMany('App\Pengaduan', 'pengaduan_category_id');
    }
}
