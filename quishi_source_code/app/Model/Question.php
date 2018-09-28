<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Career;
use App\Model\Answer;

class Question extends Model
{
    
	//a question is belongs to many careers
    public function careers(){
    	return $this->belongsToMany('App\Model\Career')->withTimeStamps();
    }


    //get the anwers
    public function answers(){
    	return $this->hasMany('App\Model\Answer');
    }
}
