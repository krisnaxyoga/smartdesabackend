<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Village;

class TipeLokasi extends Model
{
    use Village;
    /**
     * Table name.
     *
     * @var string
     */
    public $table = 'tipe_lokasi';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'icon',
        'enabled'
    ];

    /**
     * Cast attribute types.
     *
     * @var array
     */
    public $casts = [
        'enabled' => 'boolean'
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
