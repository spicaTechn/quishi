<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Question;

class Career extends Model
{
    //

    public function getParentCareer(){
    	return $this->where('parent',0)->get();
    }


   public function parent() {
    return $this->belongsTo(static::class, 'parent');
  }

  //each category might have multiple children
  public function children() {
    return $this->hasMany(static::class, 'parent')->orderBy('title', 'asc');
  }



  //each career has one to many questions associated with it
  public function questions(){
    return $this->belongsToMany('App\Model\Question');
  }
}
