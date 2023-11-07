<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class KeluargaSejahtera extends Model
{
    protected $table = 'keluarga_sejahtera';
    protected $fillable = [
        'nama'
    ];
}
