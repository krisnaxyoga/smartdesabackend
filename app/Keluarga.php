<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Village;

class Keluarga extends Model
{
    use Village;

    protected $table = 'keluarga';
    protected $fillable = [
        'no_kk',
        'nik_kepala',
        'tgl_daftar',
        'kelas_sosial',
        'tgl_cetak_kk',
        'alamat',
        'id_cluster',
        'lat',
        'lng',
    ];

    protected $appends = [
        'jml_anggota', 'data_program'
    ];

    public function getJmlAnggotaAttribute()
    {
        $member = DB::table('penduduk')
            ->selectRaw('COUNT(id) as count')
            ->where('id_kk', $this->id)
            ->first();

        return $member->count;
    }

    public function getDataProgramAttribute()
    {
        $data = DB::table('program_peserta')->where('peserta', $this->id)->where('sasaran', 2)->select('program_id')->pluck('program_id')->all();

        return $data;
    }

    public function kepalaKeluarga()
    {
        return $this->belongsTo('App\Penduduk', 'nik_kepala', 'nik');
    }

    public function dusun()
    {
        return $this->belongsTo('App\Wilayah', 'id_cluster');
    }

    public function penduduk()
    {
        return $this->hasMany('App\Penduduk', 'id_kk');
    }


    public function konversiTgl($date)
    {
        $month = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $d = date('d', strtotime($date));
        $m = date('m', strtotime($date));
        $month = $month[$m - 1];
        $year = date('Y', strtotime($date));
        return $d . " " . $month . " " . $year;
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
