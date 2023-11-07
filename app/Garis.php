<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class Garis extends Model
{
    use Village;
    /**
     * Table name.
     *
     * @var string
     */
    public $table = 'garis';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'description',
        'photo',
        'lat',
        'lng',
        'coordinates',
        'tipe_garis_id',
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
    public function tipeGaris()
    {
        return $this->belongsTo('App\TipeGaris', 'tipe_garis_id');
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
