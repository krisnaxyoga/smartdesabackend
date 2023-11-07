<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Uuid;

class Agent extends Model
{
    use SoftDeletes;

    /**
     * Disable auto increment.
     * 
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'legal_name',
        'address',
        'photo',
        'phone',
        'password',
        'email',
        'status',
        'remember_token',
        'api_token',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        // Set UUID on boot.
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }
}
