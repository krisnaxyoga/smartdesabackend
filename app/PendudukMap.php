<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendudukMap extends Model
{
    protected $table = 'penduduk_map';
    protected $fillable = [
        'lat','lng','penduduk_id'
    ];

    public function penduduk()
    {
        return $this->belongsTo('App\Penduduk');
    }
}
