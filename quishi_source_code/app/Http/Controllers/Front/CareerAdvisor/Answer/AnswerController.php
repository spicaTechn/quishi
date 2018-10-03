<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Answer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Answer;
use Auth;

class AnswerController extends Controller
{
   
    /**
    *
    * displying the list of resources
    *
    * @param void
    * @return Illuminate\Http\Response
    *
    *
    */
    public function index(){

    	$current_user_id	  = User::findOrFail(Auth::user()->id);

   		$current_user_answers = Answer::where('user_id',$current_user_id->id)->get();

    	return view('front.career-advisor.answer.answer')->with([
    		'current_user_answers'		=> $current_user_answers
    	]);
    }




    /**
    * Show the form for creating a new resource
    *
    * @param void
    * @return Illuminate\Http\Response
    *
    *
    */

    public function create(){

    }


    /**
    *
    * store a newly created resource in storage
    *
    * @param \Illumiate\Http\Reqeust $request
    * @return \Illuminate\Http\Response
    *
    */
    public function store(Request $request){

    }



    /**
    * Display the specific resources
    *
    *
    * @param int $id
    * @return Illuminate\Http\Response
    *
    */

    public function show($id){

    	//show the current users questions with the answers provided 

    	$user_answer           = Answer::findOrFail($id);
        $user_answer_question  = $user_answer->question->title;
        return response()->json(array('status'=>'success','result'=>$user_answer,'question'=>$user_answer_question),200);

    }



    /**
    * show the form for editing the specific resource
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    *
    *
    */

    public function edit($id){

    }


    /**
    * update specific resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $id
    * @return \Illuminate\Http\Response
    *
    */

    public function update(Request $request,$id){

        $user_answer            = Answer::findOrFail($id);
        $return_message         = "";
        if($request->has('type')):
            //need to update the status only
            $user_answer->status = ($user_answer->status) ? '0' : '1';
            if($user_answer->status):
                $return_message  = "Your answer is visible to the career seeker now!!";
                
            else:
                $return_message = "Your answer is not visible to the career seeker!!";
            endif;

        else:
            //udpate the user content
             $user_answer->content   = $request->input('answer_content');
        endif;
        //save the user answer
        $user_answer->save();
        return response()->json(array('status'=> 'success','result'=>'success','message'=> $return_message),200);
    }


    /**
    * Remove the specific resource from the storage
    *
    * @param int ($id)
    * @return \Illuminate\Http\Response
    * 
    *
    */
    public function destroy($id){
    	//get the answer details by the answer id


    }

}
