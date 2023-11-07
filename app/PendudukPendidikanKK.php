<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PendudukPendidikanKK extends Model
{
    protected $table = 'penduduk_pendidikan_kk';
    protected $fillable = [
        'nama'
    ];
}
