<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //

    protected $table = "addressess";


    public function users(){
    	return $this->belongsToMany('App\User','user_address');
    }
}



