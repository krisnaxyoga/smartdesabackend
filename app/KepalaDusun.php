<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KepalaDusun extends Model
{

    //
    protected $table = 'kepala_dusun';

    protected $fillable = [
        'name',
        'dusun_id',
        'username',
        'pin',
        'api_key',
        'phone','address','photo'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pin', 'remember_token',
    ];

    /**
     * Relationship
     */

    public function dusun()
    {
        return $this->belongsTo('App\Wilayah','dusun_id');
    }

    public function devices()
    {
        return $this->hasMany('App\Device','kadus_id');
    }

    public function kadus()
    {
        return $this->hasMany('App\Pengaduan', 'user_id');
    }
}
