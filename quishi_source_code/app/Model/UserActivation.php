<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserActivation extends Model
{
    //
    protected $table = "user_activation";

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
