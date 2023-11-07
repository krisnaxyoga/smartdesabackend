<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Village;

class BidangEplanning extends Model
{
    use Village;

    protected $table = 'bidang_eplanning';

    protected $fillable = [
        'id',
        'parent_id',
        'desa_id',
        'kode_bidang',
        'nama_bidang'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $model->desa_id = auth()->user()->desa_id;
        });

    }

    public function chaild()
    {
        return $this->hasMany('App\BidangEplanning', 'parent_id');
    }

    public function activity()
    {
        return $this->hasMany('App\UsulanDesa', 'sub_bidang_id', 'id')->where('rkp_id','!=', null);
    }

    public function parent()
    {
        return $this->belongsTo('App\BidangEplanning', 'parent_id');
    }
}
