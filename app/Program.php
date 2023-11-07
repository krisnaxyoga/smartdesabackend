<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Village;

class Program extends Model
{
    use Village;
    protected $table = 'program';
    protected $fillable = [
        'nama',
        'sasaran',
        'ndesc',
        'sdate',
        'edate',
        'userid',
        'status'
    ];

    public function analisisRefSubjek()
    {
        return $this->belongsTo('App\AnalisisRefSubjek','sasaran');
    }

    public function peserta()
    {
        return $this->hasMany('App\ProgramPeserta','program_id');
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
