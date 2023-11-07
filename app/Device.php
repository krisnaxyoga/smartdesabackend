<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'device_id',
        'kadus_id',
        'penduduk_id',
        'staff_id'
    ];
}
