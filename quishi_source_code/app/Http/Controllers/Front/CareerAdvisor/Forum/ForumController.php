<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ForumQuestion;
use Auth;

class ForumController extends Controller
{
    //


	/**
	 *list all the resources
	 *
	 * @param Illuminate\Http\Request
	 * @return Illuminate\Http\Respone
	 *
	 *
	 */

    public function index(){

    	//get all the forum posted by the currently logged in users
    	$career_forum_question    = ForumQuestion::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(2);
    	return view('front.career-advisor.forum.index')->with([
    		'questions'		=> $career_forum_question
    	]);

    }

    /**
     * show the form to create a new resource
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     *
     */


    public function create(){

    }

    /**
     * show the form to create a new resource
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     *
     */


    public function store(Request $request){

    }


    /**
     * show the specific resource
     *
     * @param Illuminate\Http\Request, int(id)
     * @return Illuminate\Http\Response
     *
     */


    public function show($id){

    }


    /**
     * show the specific resource to edit
     *
     * @param Illuminate\Http\Request, int(id)
     * @return Illuminate\Http\Response
     *
     */


    public function edit($id){

    }


    /**
     * update a specific resource into the storage
     *
     * @param Illuminate\Http\Request, int(id)
     * @return Illuminate\Http\Response
     *
     */


    public function update(Request $request,$id){

    }

    /**
     * delete the specific resource from the storage
     *
     * @param Illuminate\Http\Request, int(resource_id)
     * @return Illuminate\Http\Response
     *
     */

    public function destroy($id){

    }
}
