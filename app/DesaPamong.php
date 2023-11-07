<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Village;

class DesaPamong extends Model
{
    use Village;
    protected $table = 'desa_pamong';
    protected $fillable = [
        'pamong_nama',
        'pamong_nip',
        'pamong_nik',
        'jabatan',
        'pamong_status',
        'pamong_tgl_terdaftar',
        'pamong_ttd',
        'foto',
        'is_kades',
        'username',
        'password',
        'token'
    ];

    protected $casts = [
        'is_kades' => 'bool'
    ];

    protected $hidden = [
        'password'
    ];
    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->desa_id = auth()->user()->desa_id;
        });
    }

    public function devices()
    {
        return $this->hasMany('App\Device','staff_id');
    }

    public function desapamong()
    {
        return $this->hasMany('App\Pengaduan', 'user_id');
    }
}
