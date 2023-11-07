<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PendudukKawin extends Model
{
    protected $table = 'penduduk_kawin';
    protected $fillable = [
        'nama'
    ];
}
