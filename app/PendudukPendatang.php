<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Village;
class PendudukPendatang extends Model
{
    use Village;

    protected $table = 'penduduk_pendatang';
    protected $fillable = [
        'nik',
        'no_kk',
        'nama',
        'sex_id',
        'tempat_lahir',
        'tanggal_lahir',
        'golongan_darah_id',
        'agama_id',
        'status_kawin_id',
        'status_keluarga_id',
        'pendidikan_id',
        'pekerjaan_id',
        'warga_negara_id',
        'no_hp',
        'email',
        'status',
        'alasan_domisili',
        'alamat_asal',
        'desa_asal_id',
        'dusun_tinggal_id',
        'jenis_tempat_tinggal_id',
        'alamat_tinggal',
        'photo',
        'photo_ktp',
        'status_verifikasi',
        'tanggal_melapor',
        'surat',
        'no_surat_desa',
        'masa_berlaku',
        'staff_id'
    ];

    protected $appends = ['hari_melapor','tanggal_melapor_format'];

    public function jenisKelamin()
    {
        return $this->belongsTo('App\PendudukSex', 'sex_id');
    }

    public function golonganDarah()
    {
        return $this->belongsTo('App\GolonganDarah', 'golongan_darah_id');
    }

    public function agama()
    {
        return $this->belongsTo('App\PendudukAgama', 'agama_id');
    }

    public function status_kawin()
    {
        return $this->belongsTo('App\PendudukKawin', 'status_kawin_id');
    }

    public function hubungan()
    {
        return $this->belongsTo('App\PendudukHubungan', 'status_keluarga_id');
    }

    public function pendidikan()
    {
        return $this->belongsTo('App\PendudukPendidikanKK', 'pendidikan_id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo('App\PendudukPekerjaan', 'pekerjaan_id');
    }

    public function kewarganegaraan()
    {
        return $this->belongsTo('App\PendudukWarganegara', 'warga_negara_id');
    }

    public function desa_asal()
    {
        return $this->belongsTo('App\Village', 'desa_asal_id');
    }

    public function jenis_tempat_tinggal()
    {
        return $this->belongsTo('App\JenisTempatTinggal', 'jenis_tempat_tinggal_id');
    }

    public function dusun()
    {
        return $this->belongsTo('App\Wilayah', 'dusun_tinggal_id');
    }
    public function staff()
    {
        return $this->belongsTo('App\DesaPamong', 'staff_id');
    }

    public function getTanggalMelaporFormatAttribute()
    {
        return $this->konversiTgl($this->tanggal_melapor);
    }

    public function getHariMelaporAttribute()
    {
        return $this->hari_melapor($this->tanggal_melapor);
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

    public function hari_melapor($date)
    {
        $d = date('d', strtotime($date));
        $m = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $hari = date('D', strtotime($date));

        switch($hari) {
            case 'Sun':
                $hari_melapor = "Minggu";
                break;
            case 'Mon':
                $hari_melapor = "Senin";
                break;
            case 'Tue':
                $hari_melapor = "Selasa";
                break;
            case 'Wed':
                $hari_melapor = "Rabu";
                break;
            case 'Thu':
                $hari_melapor = "Kamis";
                break;
            case 'Fri':
                $hari_melapor = "Jumat";
                break;
            case 'Sat':
                $hari_melapor = "Sabtu";
                break;
        }
        return $hari_melapor.", ".$d."/".$m."/".$year;
    }
}
