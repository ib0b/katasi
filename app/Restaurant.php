<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rating;
use App\RestaurantImage;
class Restaurant extends Model
{
    //
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function restaurantImages()
    {
    	return $this->hasMany('App\RestaurantImage');
    }
    public function ratings()
    {
    	return $this->hasMany('App\Rating');
    }
}
