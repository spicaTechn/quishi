<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tag extends Model
{
    //

    public function users(){
    	return $this->belongsToMany('App\User','user_tag')->withTimeStamps();
    }
}
