<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $table = 'pages';
    //protected $fillable = ['title','slug', 'content','user_id','type'];


    public function page_detail()
    {
    	return $this->hasMany('App\PageDetail');
    }


    public function user(){
    	return $this->belongsTo('App\User');
    }

}
