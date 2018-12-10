<?php

namespace App\Http\Controllers\Front\Pages\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;
use App\User;
use DB, Auth, URL;
use App\Model\UserProfile;
use App\Model\Education, App\Model\Career;
use App\Model\Post;
use App\Model\Answer;
use App\Model\UserProfileQueries;
use Carbon\Carbon;

//notifcations
use App\Notifications\ProfileLikeNotification;
use App\Notifications\ProfileAnswerLikeNotification;
use App\Notifications\NewCommentPostedNotification;

class ProfileCommentController extends Controller
{
    //

	protected $profile_comment;
    protected $posted_comment_profile;

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


    	$recent_profile_comment       = UserProfileQueries::findOrFail($career_advisor_profile->id);
    	$this->posted_comment_profile = $recent_profile_comment;

    	//count total number of comments here
    	$all_comments        = UserProfileQueries::where('answer_id',$answer_id)->count();

  
    	//send the notification 
    	$this->sendNotificationAfterNewCommentPosted($request->input('_career_profile_id'),$answer_id);

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

    public function increaseCommentLikeCounter(Request $request)
    {
    	$career_advisor_answer_comment              = UserProfileQueries::findOrFail($request->input('_comment_id'));
    	$this->posted_comment_profile               = $career_advisor_answer_comment;
    	$current_like_counter                       = $career_advisor_answer_comment->total_likes;
    	$career_advisor_answer_comment->total_likes = $current_like_counter + 1;
    	$career_advisor_answer_comment->save();

    	//need to send the notification to the profile career advisor

    	//need to send the notification to the commentor career advisor

    	//return the response back 

    	return response()->json(array('status'=>'success','total_likes' => ($current_like_counter + 1)),200);




    }



    /**
     * function to send the notification after the new comment posted on the career advisor profile
     * @param profile_id, answer_id
     * @return void
     *
     *
     */
    protected function sendNotificationAfterNewCommentPosted($profile_id,$answer_id){

    	//get the question answered career advisor profile
    	$profile_owner         			= User::findOrFail($profile_id);

    	//no need to send the notification to the career advisor if he is commented on his profile
    	if(Auth::user()->id  != $profile_owner->id):
	    	$notification_message  			= Auth::user()->name . ' has commented on your question "' . $this->posted_comment_profile->answer->question->title .'" answer'; 
	    	$notification_commentor_image   = (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');
	    	$notification_link              = URL::to('/career-advisor/'.$profile_owner->id);  //need to add #id of the currently posted comment

	    	$profile_owner->notify(new NewCommentPostedNotification($notification_message,$notification_commentor_image,$notification_link) );
	    endif;

    	//$notification_link              = 
    	//get the profile of the comment poster and this is currently logged in career advisor
    	$comment_posted_by   = Auth::user();

    	//get other commentors who have posted comment already
    	$other_commentors    = UserProfileQueries::where('answer_id',$answer_id)
    											 ->where('user_id',$profile_id)
    											 ->whereNotIn('posted_by',array($profile_id,$this->posted_comment_profile->posted_by))
    											 ->select('posted_by')
    											 ->get();
    	//send notification to the other commentors if any

    	foreach($other_commentors as $other_commentor):
    		$other_commentor_details       = User::findOrFail($other_commentor->posted_by);
    		$notification_message          = Auth::user()->name .' also commented on "' .$profile_owner->name .' profile question "' . $this->posted_comment_profile->answer->question->title  . '" answer';
    		$notification_commentor_image  = (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');
    		$notification_link             = URL::to('/career-advisor/'.$profile_owner->id); //need to add the #id of the comment that has been posted

    		$other_commentor_details->notify(new NewCommentPostedNotification($notification_message,$notification_commentor_image,$notification_link));
    	endforeach;
    }


    /**
     * function to post a new comment reply  on the profile answer comment
     * @param 
     *
     *
     */

    public function createCommentReply(Request $request)
    {
    	$parent_comment_id      = $request->input('_parent_comment_id');
    	//get details by the parent comment id
    	$parent_comment_details = UserProfileQueries::findOrFail($parent_comment_id);
    	$reply_content          = $request->input('_quishi_comment_reply');
    	//comment posted by will be the currenlty logged in user
    	$reply_posted_by        = Auth::user()->id;


    	$this->profile_comment            =  new UserProfileQueries();
    	$this->profile_comment->answer_id = $parent_comment_details->answer_id;
    	$this->profile_comment->user_id   = $parent_comment_details->user_id;
    	$this->profile_comment->content   = $reply_content;
    	$this->profile_comment->posted_by = $reply_posted_by;
    	$this->profile_comment->parent    = $parent_comment_id;
    	$this->profile_comment->type      = ($request->has('_hide_name_'.$parent_comment_id)) ? '1' : '0';
    	$this->profile_comment->save();

    	//no need to send the notification to the career advisor if he / she has commented on her profile comment
    	if($parent_comment_details->posted_by   == $reply_posted_by){
    		//career advisor sending the reply on his own profile own complete
    	}elseif($parent_comment_details->user_id   == $parent_comment_details->posted_by){
    		//comment parent is the career advisor comment
    		$message                     = Auth::user()->name .' replied to your  comment published on your profile question "' .$parent_comment_details->answer->question->title .'" answer';
    		$notification_link           = URL::to('/career-advisor/'.$parent_comment_details->user_id);
    		$user_image                  =  (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');

    		$parent_comment_details->user->notify(new NewCommentPostedNotification($message,$user_image,$notification_link));
    	}else{
    		//comment has been posted by the other commentors on other comment 
    		$message                     = Auth::user()->name .' replied to your comment posted on "' . $parent_comment_details->user->name .'" profile question "' .$parent_comment_details->answer->question->title .'" answer';
    		$notification_link           = URL::to('/career-advisor/'.$parent_comment_details->user_id);
    		$user_image                  =  (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');
    		$parent_comment_details->comment_poster->notify(new NewCommentPostedNotification($message,$user_image,$notification_link));
    	}



    	//get the recently added comment reply
    	$comment_reply_details          = UserProfileQueries::findOrFail($this->profile_comment->id);
    	$total_reply_on_current_comment = UserProfileQueries::where('parent',$parent_comment_id)->count();
    	$return_html  = view('front.pages.profile.comment-reply')->with([
    		'comment_reply'     => $comment_reply_details,
    		'total_record'      => $total_reply_on_current_comment
    	])->render();

    	//get the total number of reply on the parent comment
    	

    	return response()->json(array('status'=>'success','result'=>$return_html,'total_reply'=>$total_reply_on_current_comment),200);

    }



}
