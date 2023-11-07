<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogPenduduk extends Model
{

    protected $table = "log_penduduk";
    protected $fillable = [
        'tgl_peristiwa',
        'penduduk_id',
        'detail_id',
        'catatan',
        'no_kk',
        'nama_kk',
    ];
}
