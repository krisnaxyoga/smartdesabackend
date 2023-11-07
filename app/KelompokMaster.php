<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelompokMaster extends Model
{
    //
    /**
     * Table name.
     *
     * @var string
     */
    public $table = 'kelompok_master';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    public $fillable = [
        'kelompok',
        'deskripsi',
    ];

}
