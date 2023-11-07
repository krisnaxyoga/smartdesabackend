<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class KelompokAnggota extends Pivot
{
    /**
     * Table name.
     *
     * @var string
     */
    public $table = 'kelompok_anggota';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    public $fillable = [
       'penduduk_id',
       'kelompok_id',
       'no_anggota',
    ];

    public function penduduk()
    {
        return $this->belongsTo('App\Penduduk','penduduk_id');
    }
}
