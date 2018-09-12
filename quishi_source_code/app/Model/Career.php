<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    //

    public function getParentCareer(){
    	return $this->where('parent',0)->get();
    }


   public function parent() {
    return $this->belongsToOne(static::class, 'parent');
  }

  //each category might have multiple children
  public function children() {
    return $this->hasMany(static::class, 'parent')->orderBy('title', 'asc');
  }
}
