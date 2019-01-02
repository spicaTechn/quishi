<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Following;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class FollowingController extends Controller
{
    //

    public function index(){

    	//need to get the following career advisor of the currently logged in career advisor
    	$logged_in_career_advisor    = User::findOrFail(Auth::user()->id);
    	$_career_advisor_following   = $logged_in_career_advisor->following()->paginate(4);

    	return view('front.career-advisor.following.index')->with([
    		'_following_advisers'    => $_career_advisor_following
    	]);
    }
}
