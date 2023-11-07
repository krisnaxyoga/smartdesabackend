<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StatusDasar extends Model
{
    protected $table = 'status_dasar';
    protected $fillable = [
        'nama'
    ];

}
