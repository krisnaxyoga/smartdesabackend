<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PendudukStatus extends Model
{
    protected $table = 'penduduk_status';
    protected $fillable = [
        'nama'
    ];

    public function penduduk()
    {
        return $this->hasMany('App\Penduduk', 'status');
    }
}
