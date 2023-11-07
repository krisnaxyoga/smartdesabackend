<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PendudukUmur extends Model
{
    protected $table = 'penduduk_umur';
    protected $fillable = [
        'nama','dari','sampai','status'
    ];
}
