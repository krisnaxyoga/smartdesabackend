<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';

    protected $fillable = [
        'desa_id',
        'title',
        'gambar',
    ];

    public function getLinkAttribute()
    {
        return env('WEB_URL').'/slider'.'/'.$this->slug.".html";
    }
}
