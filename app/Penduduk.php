<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Village;


class Penduduk extends Model
{
    use Village;

    protected $table = 'penduduk';
    protected $fillable = [
        'nama',
        'nik',
        'id_kk',
        'kk_level',
        'id_rtm',
        'rtm_level',
        'sex',
        'tempatlahir',
        'tanggallahir',
        'agama_id',
        'pendidikan_kk_id',
        'pendidikan_sedang_id',
        'pekerjaan_id',
        'status_kawin_id',
        'warganegara_id',
        'dokumen_paspor',
        'dokumen_kitas',
        'ayah_nik',
        'ibu_nik',
        'nama_ayah',
        'nama_ibu',
        'foto',
        'golongan_darah_id',
        'dusun_id',
        'status',
        'alamat_sebelumnya',
        'alamat_sekarang',
        'status_dasar',
        'hamil',
        'cacat_id',
        'sakit_menahun_id',
        'akta_lahir',
        'akta_perkawinan',
        'tanggalperkawinan',
        'akta_perceraian',
        'tanggalperceraian',
        'cara_kb_id',
        'telepon',
        'tanggal_akhir_paspor',
        'no_kk_sebelumnya',
        'ktp_el',
        'status_rekam_id',
        'waktu_lahir',
        'tempat_dilahirkan_id',
        'jenis_kelahiran_id',
        'kelahiran_anak_ke',
        'penolong_kelahiran_id',
        'berat_lahir',
        'panjang_lahir',
        'token',
        'suku_id',
        'job_description'
    ];

    protected $appends = ['tanggal_lahir_format', 'umur'];


    public function keluarga()
    {
        return $this->belongsTo('App\Keluarga', 'id_kk');
    }

    public function jenisKelamin()
    {
        return $this->belongsTo('App\PendudukSex', 'sex');
    }

    public function agama()
    {
        return $this->belongsTo('App\PendudukAgama', 'agama_id');
    }

    public function suku()
    {
        return $this->belongsTo('App\Suku', 'suku_id');
    }

    public function pendidikan()
    {
        return $this->belongsTo('App\PendudukPendidikan', 'pendidikan_sedang_id');
    }



    public function hubungan()
    {
        return $this->belongsTo('App\PendudukHubungan', 'kk_level');
    }

    public function pendidikanKK()
    {
        return $this->belongsTo('App\PendudukPendidikanKK', 'pendidikan_kk_id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo('App\PendudukPekerjaan', 'pekerjaan_id');
    }

    public function kewarganegaraan()
    {
        return $this->belongsTo('App\PendudukWarganegara', 'warganegara_id');
    }


    public function jenis_kelahiran()
    {
        return $this->belongsTo('App\JenisKelahiran', 'jenis_kelahiran_id');
    }

    public function sakit_menahun()
    {
        return $this->belongsTo('App\SakitMenahun', 'sakit_menahun_id');
    }


    public function cacat()
    {
        return $this->belongsTo('App\Cacat', 'cacat_id');
    }

    public function desa()
    {
        return $this->belongsTo('App\Desa', 'desa_id');
    }


    public function cara_kb()
    {
        return $this->belongsTo('App\CaraKB', 'cara_kb_id');
    }

    public function tempat_dilahirkan()
    {
        return $this->belongsTo('App\TempatDilahirkan', 'tempat_dilahirkan_id');
    }

    public function dusun()
    {
        return $this->belongsTo('App\Wilayah', 'dusun_id');
    }

    public function golonganDarah()
    {
        return $this->belongsTo('App\GolonganDarah', 'golongan_darah_id');
    }

    public function penolong_kelahiran()
    {
        return $this->belongsTo('App\PenolongKelahiran', 'penolong_kelahiran_id');
    }


    public function status_kawin()
    {
        return $this->belongsTo('App\PendudukKawin', 'status_kawin_id');
    }

    public function penduduk_map()
    {
        return $this->hasMany('App\PendudukMap', 'penduduk_id');
    }

    public function getTanggalLahirFormatAttribute()
    {
        return $this->konversiTgl($this->tanggallahir);
    }

    public function getUmurAttribute()
    {
        return round((time() - strtotime($this->tanggallahir)) / (3600 * 24 * 365.25));
        // return (int)(date('Y')) - (int)(date('Y',strtotime($this->tanggallahir)));
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

    public function kelompok()
    {
        return $this->hasMany('App\KelompokAnggota', 'penduduk_id');
    }

    public function devices()
    {
        return $this->hasMany('App\Device', 'penduduk_id');
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
