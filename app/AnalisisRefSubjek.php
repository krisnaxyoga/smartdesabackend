<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AnalisisRefSubjek extends Model
{
    protected $table = 'analisis_ref_subjek';
    protected $fillable = [
        'subjek'
    ];
}
