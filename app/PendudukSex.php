<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PendudukSex extends Model
{
    protected $table = 'penduduk_sex';
    protected $fillable = [
        'nama'
    ];
}
