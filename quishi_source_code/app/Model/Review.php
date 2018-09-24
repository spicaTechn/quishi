<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Review extends Model
{
    //
	protected $table = "user_reviews";

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
