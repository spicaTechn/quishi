<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserProfileQueries extends Model
{
    //

    protected $table = "user_profile_queries";


    public function user(){
    	return  $this->belongsTo('App\User','user_profile_queries','id','user_id');
    }

    public function answer(){
    	return $this->belongsTo('App\Model\Answer');
    }

    public function comment_parent(){
    	return $this->belongsTo('App\Model\UserProfileQueries','id','parent');
    }

    public function childern(){
    	return $this->hasMany('App\Model\UserProfileQueries','parent','id');
    }
}
