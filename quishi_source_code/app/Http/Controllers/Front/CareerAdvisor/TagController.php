<?php

namespace App\Http\Controllers\Front\CareerAdvisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tag;

class TagController extends Controller
{
    //


    public function index(){
    	$tags = Tag::select('title')->get();
    	
    		return response()->json(array('nepal','india','kathamdnu'));
    	
    }
}
