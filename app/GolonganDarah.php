<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GolonganDarah extends Model
{
    protected $table = 'golongan_darah';
    protected $fillable = [
        'nama'
    ];
}
