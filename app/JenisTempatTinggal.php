<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisTempatTinggal extends Model
{
    protected $table = 'jenis_tempat_tinggal';
    protected $fillable = [
        'nama'
    ];

    public function jenis_tempat_tinggal()
    {
        return $this->hasMany('App\PendudukPendatang', 'jenis_tempat_tinggal_id');
    }
}
