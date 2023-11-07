<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;
use App\Desa;

class UsulanDusun extends Model
{
    use Village;

    protected $table = "usulan_dusun";
    protected $fillable = [
        'desa_id',
        'pengusul_type',
        'pengusul_id',
        'tahun',
        'keterangan',
        'attachment'
    ];

    protected $appends = ['pengusul'];

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

    public function wilayah()
    {
        return $this->belongsTo('App\Wilayah', 'pengusul_id');
    }

    public function kelompok()
    {
        return $this->belongsTo('App\Kelompok', 'pengusul_id');
    }

    public function getPengusulAttribute()
    {
        if ($this->pengusul_type == "DUSUN" || $this->pengusul_type == "dusun") {
            $data = $this->wilayah()->select('dusun as nama')->first();
            if ($data != null) {
                return $data->nama;
            } else {
                return "-";
            }
        } elseif($this->pengusul_type == "KELOMPOK" || $this->pengusul_type == "KELOMPOK") {
            $data = $this->kelompok()->with('kategori')->first();
            if ($data != null) {
                return $data->nama.' ( '.$data->kategori->kelompok.' )';
            } else {
                return "-";
            }
        } else{
            return "-";
        }
    }
}
