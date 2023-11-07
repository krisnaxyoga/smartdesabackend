<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;
// use App\BidangEplanning;
// use App\Wilayah;

class UsulanDesa extends Model
{
    use Village;

    protected $table = 'kegiatan_eplanning';
    protected $fillable = [
        'rkp_id',
        'bidang_id',
        'sub_bidang_id',
        'sumber_biaya_id',
        'wilayah_id',
        'nama_kegiatan',
        'volume',
        'manfaat',
        'start_date',
        'estimated_time',
        'attachment',
        'swakelola',
        'kerjasama_antardesa',
        'kerjasama_pihak_ketiga',
        'jumlah',
        'sumber_biaya',
        'rencana_pelaksana_kegiatan',
        'status',
    ];

    public function wilayah()
    {
        return $this->belongsTo('App\Wilayah', 'wilayah_id', 'id');
    }

    public function biaya()
    {
        return $this->belongsTo('App\RkpSumberDana', 'sumber_biaya', 'id');
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

    public function bidang()
    {
        return $this->belongsTo('App\BidangEplanning', 'sub_bidang_id');
    }
}
