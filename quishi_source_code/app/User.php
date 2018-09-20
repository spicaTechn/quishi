<?php

namespace App;

use App\Model\UserProfile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\Career;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    //a user have one user_profile 

    public function user_profile(){
        return $this->hasOne('App\Model\UserProfile');
    }


    public function careers(){
        return $this->belongsToMany('App\Model\Career','user_career');
    }

    public function tags(){
        return $this->belongsToMany('App\Model\Tag','user_tag');
    }
}
