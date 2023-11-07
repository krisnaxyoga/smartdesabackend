<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;
use DB;

class PengajuanSurat extends Model
{
    use Village;
    //
    protected $table = 'pengajuan_surat';


    protected $fillable = [
        'dusun_id',
        'keperluan',
        'keterangan',
        'penduduk_id',
        'jenis_surat_id',
        'nomor_surat',
        'berlaku_dari',
        'berlaku_sampai',
        'staff_id',
        'staff_sebagai_id',
        'jenis_acara',
        'no_kk',
        'no_surat_pengantar',
        'status',
        'is_mobile',
        'tanggal_pengajuan',
        'tanggal_verifikasi',
        'tanggal_cetak',
        'remark_kadus',
        'track_number',
        'nama_usaha',
        'alamat_usaha',
        'jenis_usaha',
        'nama_pasangan',
        'tahun_kawin',
        'lokasi_kawin',
        'pernyataan_status',
        "pindah_desa",
        "pindah_kec",
        "pindah_kab",
        "pindah_prov",
        "tanggal_pindah",
        "tanggal_kk",
        'tahun_menetap',
        "nama_dusun",
        "nama_desa",
        "nama_kecamatan",
        "nama_kabupaten",
        "nama_provinsi",
        'tanggal_meninggal',
        'lokasi_meninggal',
        'penyebab_meninggal',
        'nama_pelapor',
        'nik_pelapor',
        'hubungan_pelapor',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $token =  request()->bearerToken();
            $user = DB::table('penduduk')->where('token',$token)->first();
            if(!$user) {
                $user = auth()->user();
            }
            $model->desa_id = $user->desa_id;
            $desa = DB::table('desa')->where('id',$user->desa_id)->first();
            if ($model->is_mobile) {
                $track = "";
                $track = PengajuanSurat::where('is_mobile', 1)
                    ->where('tanggal_pengajuan', '>=', date('y-m-') . "01")
                    ->where('tanggal_pengajuan', '<=', date('y-m-t'))
                    ->where('jenis_surat_id', $model->jenis_surat_id)
                    ->count();


                $track = str_pad($track + 1, 4, '0', STR_PAD_LEFT);

                $jenisSurat = JenisSurat::find($model->jenis_surat_id);

                $track = "PMH/$desa->akronim/$jenisSurat->kode_surat/" . date('m') . '/' . $track;
                $model->track_number = $track;
                $model->tanggal_pengajuan = date('Y-m-d');
            }
        });
    }

    // protected $casts = [

    // ]

    public function penduduk()
    {
        return $this->belongsTo('App\Penduduk', 'penduduk_id');
    }

    public function jenisSurat()
    {
        return $this->belongsTo('App\JenisSurat', 'jenis_surat_id');
    }

    public function dusun()
    {
        return $this->belongsTo('App\Wilayah', 'dusun_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\DesaPamong', 'staff_id');
    }

    public function staffSebagai()
    {
        return $this->belongsTo('App\DesaPamong', 'staff_sebagai_id');
    }


    public function anggota()
    {
        return $this->hasMany('App\SuratAnggota', 'pengajuan_surat_id');
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
}
