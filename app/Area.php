<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class Area extends Model
{
    use Village;
    /**
     * Table name.
     *
     * @var string
     */
    public $table = 'area';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'description',
        'photo',
        'coordinates',
        'tipe_area_id',
        'dusun_id',
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
     * Location types.
     */
    public function tipeArea()
    {
        return $this->belongsTo('App\TipeArea', 'tipe_area_id');
    }

    /**
     * Mutator for coordinates.
     */
    public function getCoordinatesAttribute()
    {
        return json_decode($this->attributes['coordinates']);
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
