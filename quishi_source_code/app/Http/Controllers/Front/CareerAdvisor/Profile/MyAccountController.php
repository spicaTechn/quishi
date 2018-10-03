<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyAccountController extends Controller
{
    //

    /**
    * to show the particular account resource
    *
    * @param void
    * @return \Illuminate\Http\Response
    *
    *
    **/

    public function index(){
    	//
    	return view('front.career-advisor.my-account.index');

    }



    /**
    * to show the form to create the new resources
    * @param int ($id)
    *
    *
    *
    *
    *
    **/
    public function create(){

    }


    public function update(Request $request,$id){
    	echo $id;
    }
}
