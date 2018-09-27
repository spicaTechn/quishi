<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //

	//each education major category may have mutliple major
    public function children(){
    	return $this->hasMany('App\Model\Education','parent','id');

    }


    //echo education major may have one education major category
    public function parent_education(){
    	return $this->hasOne('App\Model\Education','id','parent');

    }


    public function user_profiles(){
    	return $this->hasMany('App\Model\UserProfile');
    }
}
