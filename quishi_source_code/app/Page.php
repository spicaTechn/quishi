<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $table = 'pages';
    protected $fillable = ['page_id','meta_key', 'meta_value'];

    public function page_detail()
    {
    	return $this->hasMany('App\PageDetail');
    }

}
