<?php

namespace App;
use App\Restaurant;
use Illuminate\Database\Eloquent\Model;

class RestaurantImage extends Model
{
    //
    public function restaurant()
    {
    	return $this->belongsTo('App\Restaurant');
    }

}
