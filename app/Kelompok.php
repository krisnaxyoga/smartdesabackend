<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

use App\Traits\Village;

class Kelompok extends Model
{
    use Village;

    /**
     * Table name.
     *
     * @var string
     */
    public $table = 'kelompok';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    public $fillable = [
        'kelompok_master_id',
        'ketua_id',
        'nama',
        'keterangan',
        'kode',
    ];

    protected $appends = [
        'jml_anggota'
    ];

    public function getJmlAnggotaAttribute()
    {
        return DB::table('kelompok_anggota')->where('kelompok_id', $this->id)->count();
    }

    public function anggota()
    {
        return $this->hasMany('App\KelompokAnggota', 'kelompok_id');
    }

    public function ketua()
    {
        return $this->belongsTo('App\Penduduk', 'ketua_id');
    }

    public function kategori()
    {
        return $this->belongsTo('App\KelompokMaster', 'kelompok_master_id');
    }

    public function dataAnggota()
    {
        return $this->belongsToMany('App\Penduduk', 'kelompok_anggota', 'kelompok_id', 'penduduk_id')->withPivot('no_anggota');
    }

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

}
