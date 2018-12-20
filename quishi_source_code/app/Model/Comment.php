<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    public function post(){
    	return $this->belongsTo('App\Model\Post');
    }

    public function comment_poster(){
    	return  $this->belongsTo('App\User','posted_by','id');
    }

    public function comment_parent(){
    	return $this->belongsTo('App\Model\Comment','id','parent');
    }

    public function childern(){
    	return $this->hasMany('App\Model\Comment','parent','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }


    
}
