<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class Lokasi extends Model
{
    use Village;
    /**
     * Table name.
     *
     * @var string
     */
    public $table = 'lokasi';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'description',
        'lat',
        'lng',
        'photo',
        'tipe_lokasi_id',
        'dusun_id',
        'cluster_id',
        'enabled'
    ];

    /**
     * Cast attribute types.
     *
     * @var array
     */
    public $casts = [
        'enabled' => 'boolean',
        'lat' => 'float',
        'lng' => 'float'
    ];

    /**
     * Location types.
     */
    public function tipeLokasi()
    {
        return $this->belongsTo('App\TipeLokasi', 'tipe_lokasi_id');
    }

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
