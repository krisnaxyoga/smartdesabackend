<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PendudukAgama extends Model
{
    protected $table = 'penduduk_agama';
    protected $fillable = [
        'nama'
    ];
}
