<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suku extends Model
{
    //
    protected $table = 'suku';
    protected $fillable = [
        'nama'
    ];
}
