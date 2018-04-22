<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackItem extends Model
{
    public function cart()
    {
        return $this->belongsTo('App\Track');
    }
    public function track()
    {
        return $this->belongsTo('App\Track');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
