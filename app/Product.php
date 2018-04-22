<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function file()
    {
        return $this->belongsTo('App\File');
    }
    public function trackItem()
    {
        return $this->belongsTo('App\TrackItem');
    }
    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }
}