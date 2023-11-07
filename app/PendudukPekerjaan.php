<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PendudukPekerjaan extends Model
{
    protected $table = 'penduduk_pekerjaan';
    protected $fillable = [
        'nama'
    ];
}
