<?php

namespace App\Http\Controllers\Front\Pages\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;
use App\User;
use DB, Auth;
use App\Model\UserProfile;
use App\Model\Education, App\Model\Career;
use App\Model\Post;
use App\Model\Answer;
use App\Model\UserProfileQueries;
use Carbon\Carbon;

//notifcations
use App\Notifications\ProfileLikeNotification;
use App\Notifications\ProfileAnswerLikeNotification;

class ProfileCommentController extends Controller
{
    //

    //function to increase the like counter of the career advisor public question answers

    public function increaseLikeCounter(Request $request){

      $affected_answer   = Answer::where('user_id',$request->input('_affected_user_id'))
                                 ->where('question_id',$request->input('_liked_question_id'))
                                 ->firstOrFail();


      $affected_question  = $affected_answer->question;
      if($affected_answer){
        $current_like_counter = $affected_answer->total_likes;
        //increase number by 1
        $added_like_counter   = $current_like_counter + 1;

        //update the record
        $affected_answer->total_likes  = $added_like_counter;
        $affected_answer->save();

        //check for the notification 
        if(Auth::check()):
          //logged in
          if(Auth::user()->id  == $request->input('_affected_user_id')):
            //not need to send notification when like by the same career advisor
          else:
            //check for the admin or 
            if(Auth::user()->logged_in_type == '1'):
              //not need to send notifications to the super admin
            else:
              //send the notifications
              $affected_answer->user->notify(new ProfileAnswerLikeNotification($affected_answer,$affected_question));
            endif;
          endif;
        else:
          //not logged in 
          $affected_answer->user->notify(new ProfileAnswerLikeNotification($affected_answer,$affected_question));
        endif;

        //return response back to server
        return response()->json(array('status'=>'success','result'=>$added_like_counter),200);
      }
    }


    /**
     * function to add new comment on the career advisor question answer
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     *
     */

    public function createComment(Request $request)
    {

    	$comment_parent  = $request->input('_parent_comment_id');
    	$answer_id       = $request->input('answer_id');
    	$message         = $request->input('_comment_message');
 
    	if($request->has('_hide_name'.$request->input('question_id'))):
    		$type   = '1';
    	else:
    		$type   = '0';
    	endif;

    	//insert the new comment on the career advisor profile queries
    	$career_advisor_profile            = new UserProfileQueries();
    	$career_advisor_profile->user_id   = $request->input('_career_profile_id');
    	$career_advisor_profile->answer_id = $answer_id;
    	$career_advisor_profile->content   = $message;
    	$career_advisor_profile->parent    = $comment_parent;
    	$career_advisor_profile->posted_by = Auth::user()->id;
    	$career_advisor_profile->posted_on = new Carbon();
    	$career_advisor_profile->type      = $type;
    	$career_advisor_profile->save();


    	$recent_profile_comment = UserProfileQueries::findOrFail($career_advisor_profile->id);

    	//count total number of comments here
    	$all_comments        = UserProfileQueries::where('answer_id',$answer_id)->count();

    	// to do
    	//send the notification to the career profile owner 

    	//send notification to the other commentors if any

    	$return_html   = view('front.pages.profile.comment')->with([
    		'recent_comments'    => $recent_profile_comment
    	])->render();
    	return response()->json(array('status'=>'success','result'=>$return_html,'total_comment'=>$all_comments),200);
    }


    /**
     * function to add new like on the career profile answer comment
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     *
     *
 	 */

    public function increaseCommentLikeCounter(Request $request){
    	$career_advisor_answer_comment  = UserProfileQueries::findOrFail($request->input('_comment_id'));
    	$current_like_counter           = $career_advisor_answer_comment->total_likes;
    	$career_advisor_answer_comment->total_likes = $current_like_counter + 1;
    	$career_advisor_answer_comment->save();

    	//need to send the notification to the profile career advisor

    	//need to send the notification to the commentor career advisor

    	//return the response back 

    	return response()->json(array('status'=>'success','total_likes' => ($current_like_counter + 1)),200);




    }



}
