<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class PengaduanComment extends Model
{
    public $table = 'pengaduan_comments';

    public $fillable = [
        'desa_id',
        'pengaduan_id',
        'user_type',
        'user_id',
        'content',
        'photo',

    ];

    protected $appends = ['comment_by','comment_jabatan'];

    public function comment()
    {
        return $this->belongsTo('App\Pengaduan', 'pengaduan_id');
    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function desa()
    {
        return $this->belongsTo('App\DesaPamong', 'user_id');
    }

    public function kadus()
    {
        return $this->belongsTo('App\KepalaDusun', 'user_id');
    }

    public function penduduk()
    {
        return $this->belongsTo('App\Penduduk', 'user_id');
    }

    public function getCommentByAttribute()
    {
        if ($this->user_type == "ADMIN") {
            $data =  $this->admin()->select('name as nama')->join('desa', 'desa.id', '=', 'users.desa_id')->first();
            $admin = $data->nama;

            return $admin;

        } elseif($this->user_type == "DESA") {

            $data = $this->desa()->select('pamong_nama as nama')->first();

            $staff = $data->nama;

            return $staff;

        } elseif($this->user_type == "KADUS") {
            $data = $this->kadus()->select('name as nama')->join('wilayah', 'wilayah.id', '=', 'kepala_dusun.dusun_id')->first();
            $kadus = $data->nama;
            return $kadus;
        } else {
            $data = $this->penduduk()->select('nama')->first();
            $penduduk = $data->nama;
            return $penduduk;
        }
    }

    public function getCommentJabatanAttribute()
    {
        if ($this->user_type == "ADMIN") {
            $data =  $this->admin()->select('nama_desa as jabatan')->join('desa', 'desa.id', '=', 'users.desa_id')->first();
            $admin = 'Admin Desa '.$data->jabatan;
            return $admin;

        } elseif($this->user_type == "DESA") {

            $data =  $this->desa()->select('jabatan')->first();

            $staff = $data->jabatan;

            return $staff;

        } elseif($this->user_type == "KADUS") {
            $data = $this->kadus()->select('wilayah.dusun as jabatan')->join('wilayah', 'wilayah.id', '=', 'kepala_dusun.dusun_id')->first();
            $kadus = 'Kepala '.$data->jabatan;
            return $kadus;
        } else {
            return '-';
        }
    }
}
