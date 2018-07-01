<?php

namespace App;
use App\Restaurant;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    public function restaurant()
    {
    	return $this->belongsTo('App\Restaurant');
    }
}
