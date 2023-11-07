<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Village;
use DB;

class Notification extends Model
{
    use Village;

    protected $fillable = [
        'title',
        'description',
        'ref_id',
        'type',
        'ref_type',
        'photo'
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $token =  request()->bearerToken();
            $user = DB::table('penduduk')->where('token',$token)->first();
            if(!$user) {
                $user = auth()->user();
            }
            
            $model->desa_id = $user->desa_id;
        });
    }
}
