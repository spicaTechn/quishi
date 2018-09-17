<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Career;

class Question extends Model
{
    
	//a question is belongs to many careers
    public function careers(){
    	return $this->belongsToMany('App\Model\Career')->withTimeStamps();
    }
}
