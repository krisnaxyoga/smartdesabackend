<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PendudukWarganegara extends Model
{
    protected $table = 'penduduk_warganegara';
    protected $fillable = [
        'nama'
    ];
}
