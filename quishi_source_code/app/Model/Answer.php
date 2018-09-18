<?php

namespace App\Model;

use App\Model\Question;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //

	public function question(){
		return $this->belongsTo('App\Model\Question');
	}
}
