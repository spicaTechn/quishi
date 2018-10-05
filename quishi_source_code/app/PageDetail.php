<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageDetail extends Model
{
    //
    protected $table = 'page_detail';
    //protected $fillable = ['page_id','meta_key', 'meta_value'];

    public function page()
    {
    	return $this->belongsTo('App\Page');
    }
}
