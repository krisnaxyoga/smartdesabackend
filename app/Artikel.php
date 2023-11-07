<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Traits\Village;
class Artikel extends Model
{
    //
    use Village;
    protected $table = "artikel";
    protected $fillable = [
        'user_id',
        'judul',
        'konten',
        'slug',
        'gambar',
        'kategori_artikel_id',
        'type',
        'status',
        'show_slider'
    ];

    protected $appends = [
        'link',
        'detail_link',
        'deskripsi_singkat'
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
    public function kategori()
    {
        return $this->belongsTo('App\KategoriArtikel','kategori_artikel_id');
    }
    
    public function getLinkAttribute()
    {
        $desa = DB::table('desa')->select("*")->where('id',$this->desa_id)->first();
        $url = "";
        if($desa) {
            $url = $desa->website;
        }
        return $url.'/berita'.'/'.$this->slug."";
    }

    public function getDeskripsiSingkatAttribute()
    {
        return substr((strip_tags($this->konten)) ,0,120)."...";
    }

    public function getDetailLinkAttribute()
    {
        $desa = DB::table('desa')->select("*")->where('id',$this->desa_id)->first();
        $url = "";
        if($desa) {
            $url = $desa->website;
        }
        return $url.'/berita'.'/'.$this->slug."";
    }

}
