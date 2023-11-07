<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = [
        'regency_id',
        'name'
    ];

    public function regencie()
    {
        return $this->belongsTo('App\Regencie', 'regency_id');
    }
}
