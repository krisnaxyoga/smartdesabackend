<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regencie extends Model
{
    protected $table = 'regencies';
    protected $fillable = [
        'province_id',
        'name'
    ];

    public function province()
    {
        return $this->belongsTo('App\Province', 'province_id');
    }
}
