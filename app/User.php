<?php

namespace App;
use App\Restaurant;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','mobile_number','country','city','verification_token','verified'
            
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function isVerified()
    {
       return $this->verified;
    }

    public function restaurants()
    {
        return $this->hasMany('App\Restaurant');
    }
    public function ratings()
    {
        return $this->hasMany('App\Restaurant');
    }
    public function claimed()
    {
        $parts = Part::where('receiver_id',$this->id)->get();
        return $parts;
    }
    public function reserved()
    {
        $parts = Part::where('receiver_id',$this->id);
        return $parts;
    }
    
}
