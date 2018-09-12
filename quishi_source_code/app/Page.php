<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $table = 'pages';

    public function page_detail()
    {
    	return $this->hasMany('App\PageDetail');
    }

}
