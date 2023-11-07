<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PendudukPendidikan extends Model
{
    protected $table = 'penduduk_pendidikan';
    protected $fillable = [
        'nama'
    ];
}
