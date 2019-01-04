<?php

namespace App\Http\Controllers\Front\Pages\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ForumQuestion;
use App\Model\ForumQuestionAnswer;
use App\User;
use Auth, Carbon\Carbon, URL;

//notifications
use App\Notifications\NewCommentPostedNotification;
use App\Notifications\CommentLikeNotification;


class ForumAnswerController extends Controller
{
    //

    protected $recent_forum_answer;


	/**
	 * to create new forum answer
	 *
	 * @param Illuminate\Http\Request
	 * @param Illuminate\Http\Respone
	 *
	 */

    public function createAnswer(Request $request){


    	//get the request

        $answer_parent            = $request->input('_parent_comment_id');
        $forum_question_id        = $request->input('_parent_post_id');
        $forum_question_poster_id = $request->input('_blog_career_advisor_id');
        $message                  = $request->input('_comment_message');

    	//get the question details by the question id
    	$forum_question                                 = ForumQuestion::findOrFail($forum_question_id);

    	$this->recent_forum_answer 						= new ForumQuestionAnswer();
    	$this->recent_forum_answer->forum_question_id   = $forum_question->id;
    	$this->recent_forum_answer->user_id             = $forum_question->user_id; //forum question poster id
    	$this->recent_forum_answer->content 			= $message;
    	$this->recent_forum_answer->parent              = 0;
    	$this->recent_forum_answer->answered_on         = Carbon::now();
    	$this->recent_forum_answer->type                = ($request->has('_hide_name')) ? '1' : '0';
    	$this->recent_forum_answer->posted_by           = Auth::user()->id; 
    	$this->recent_forum_answer->save();

    	$recent_forum_answer          = ForumQuestionAnswer::findOrFail($this->recent_forum_answer->id);
        $this->recent_forum_answer    = $recent_forum_answer;

        //count total number of comments here
        $all_answers       = ForumQuestionAnswer::where('forum_question_id',$forum_question->id)->where('parent',0)->count();

    	//send the notifications
    	 $this->newAnswerCreatedNotification($forum_question_poster_id,$forum_question_id);

    	$return_html   = view('front.pages.profile.forum-answer')->with([
            'recent_comments'    => $recent_forum_answer
        ])->render();
        return response()->json(array('status'=>'success','result'=>$return_html,'total_comment'=>$all_answers),200);

    }


    /**
     * function to create new forum answer reply
     * @param Illuminate\Http\Request
     * @param Illuminate\Http\Respone
     *
     */


    public function createAnswerReply(Request $request){

        $parent_comment_id      = $request->input('_parent_comment_id');
        //get details by the parent comment id
        $parent_comment_details = ForumQuestionAnswer::findOrFail($parent_comment_id);
        $reply_content          = $request->input('_quishi_comment_reply');
        //comment posted by will be the currenlty logged in user
        $reply_posted_by        = Auth::user()->id;


        $this->recent_forum_answer                      =  new ForumQuestionAnswer();
        $this->recent_forum_answer->forum_question_id   = $parent_comment_details->forum_question_id;
        $this->recent_forum_answer->user_id             = $parent_comment_details->user_id;
        $this->recent_forum_answer->content   			= $reply_content;
        $this->recent_forum_answer->posted_by           = $reply_posted_by;
        $this->recent_forum_answer->parent              = $parent_comment_id;
        $this->recent_forum_answer->answered_on         = Carbon::now();
        $this->recent_forum_answer->type                = ($request->has('_hide_name_'.$parent_comment_id)) ? '1' : '0';
        $this->recent_forum_answer->save();

        //no need to send the notification to the career advisor if he / she has commented on her profile comment
        if($parent_comment_details->posted_by   == $reply_posted_by){
            //career advisor sending the reply on his own profile own complete
        }elseif($parent_comment_details->user_id   == $parent_comment_details->posted_by){
            //comment parent is the career advisor comment
            $message                     = Auth::user()->name .' replied to your  answer published on your forum question "' .$parent_comment_details->forum_question->title .'"';
            $notification_link           = URL::to('/fourms/'.$parent_comment_details->forum_question_id.'/'.$parent_comment_details->forum_question->slug ."#blog-comment-reply".$this->recent_forum_answer->id);
            $user_image                  =  (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');

            $parent_comment_details->user->notify(new NewCommentPostedNotification($message,$user_image,$notification_link));
        }else{
            //comment has been posted by the other commentors on other comment 
            if(Auth::user()->id != $parent_comment_details->user_id):
            $message                     = Auth::user()->name .' replied to your answer posted on "' . $parent_comment_details->user->name .'" fourm question "' .$parent_comment_details->forum_question->title .'" ';
            else:
                $message                     = Auth::user()->name .' replied to your answer posted on his / her forum question "' .$parent_comment_details->forum_question->title .'" ';
            endif;

            $notification_link           = URL::to('/forums/'.$parent_comment_details->forum_question_id.'/'.$parent_comment_details->forum_question->slug ."#blog-comment-reply".$this->recent_forum_answer->id);


            $user_image                  =  (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');

            $parent_comment_details->answer_poster->notify(new NewCommentPostedNotification($message,$user_image,$notification_link));
        }



        //get the recently added comment reply
        $comment_reply_details          = ForumQuestionAnswer::findOrFail($this->recent_forum_answer->id);
        $total_reply_on_current_comment = ForumQuestionAnswer::where('parent',$parent_comment_id)->count();
        $return_html  = view('front.pages.profile.forum-answer-reply')->with([
            'comment_reply'     => $comment_reply_details,
            'total_record'      => $total_reply_on_current_comment
        ])->render();

        //get the total number of reply on the parent comment
        

        return response()->json(array('status'=>'success','result'=>$return_html,'total_reply'=>$total_reply_on_current_comment),200);


    }


    /**
     * to send the notification when new forum answer has been posted
     *
     * @param notify_user, Illuminate\Http\Request
     * @return bolean true / false
     *
     */


    public function newAnswerCreatedNotification($forum_question_poster_id,$forum_question_id){

    	//get the fourm question posted profile
        $forum_question_owner                  = User::findOrFail($forum_question_poster_id);

        //no need to send the notification to the career advisor if he is commented on his profile
        if(Auth::user()->id  != $forum_question_owner->id):
            $notification_message           = Auth::user()->name . ' has posted new answer on your forum question "' . $this->recent_forum_answer->forum_question->title .'"'; 
            $notification_commentor_image   = (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');
            $notification_link              = URL::to('/forums/'.$forum_question_id.'/'.$this->recent_forum_answer->forum_question->slug);  //need to add #id of the currently posted comment

            $forum_question_owner->notify(new NewCommentPostedNotification($notification_message,$notification_commentor_image,$notification_link) );
        endif;

        //$notification_link              = 
        //get the profile of the comment poster and this is currently logged in career advisor
        $answer_posted_by   = Auth::user();

        //get other commentors who have posted comment already
        $other_commentors    = ForumQuestionAnswer::where('forum_question_id',$forum_question_id)
                                      ->where('user_id',$forum_question_poster_id)
                                      ->whereNotIn('posted_by',array($forum_question_poster_id,$this->recent_forum_answer->posted_by))
                                      ->where('parent',0)
                                      ->select('posted_by')
                                      ->distinct()
                                      ->get();
        //send notification to the other commentors if any

        foreach($other_commentors as $other_commentor):
            $other_commentor_details       = User::findOrFail($other_commentor->posted_by);
            //check for the profile question owner
            if(Auth::user()->id != $forum_question_owner->id):
                $notification_message          = Auth::user()->name .' also posted answer on ' .$forum_question_owner->name .' forum question "' . $this->recent_forum_answer->forum_question->title  . '"';
            else:
                $notification_message          = Auth::user()->name .' also posted answer on his forum question "' . $this->recent_forum_answer->forum_question->title  . '"';
            endif;
            $notification_commentor_image  = (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');
            $notification_link             = URL::to('/forums/'.$forum_question_id.'/'.$this->recent_forum_answer->forum_question->slug); //need to add the #id of the comment that has been posted

            $other_commentor_details->notify(new NewCommentPostedNotification($notification_message,$notification_commentor_image,$notification_link));
        endforeach;

    }

    /**
     * function to send the notification when new reply has been posted on the forum answer
     *
     *
     *
     *
     *
     */

   	public function newAnswerReplyNotification(){

   	}



   	/**
     * function to add new like on the career profile answer comment
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     *
     *
     */

    public function increaseAnswerLikeCounter(Request $request)
    {
        $career_advisor_answer_comment                    = ForumQuestionAnswer::findOrFail($request->input('_comment_id'));
        //$this->posted_comment_profile                     = $career_advisor_answer_comment;
        $current_like_counter                             = $career_advisor_answer_comment->total_like_counts;
        $career_advisor_answer_comment->total_like_counts = $current_like_counter + 1;
        $career_advisor_answer_comment->save();

        //send the notification to the commentor
        $profile_owner_details                      = User::findOrFail($career_advisor_answer_comment->user_id);
        $comment_owner_details                      = User::findOrFail($career_advisor_answer_comment->posted_by);
        //check the career advisor like his / her own comment or not
        if(Auth::check()):
            if($career_advisor_answer_comment->posted_by == Auth::user()->id):
                return response()->json(array('status'=>'success','total_likes' => ($current_like_counter + 1)),200);
            endif;
        endif;
        //check for the logged in user or not
        if(Auth::check()):
        	if(Auth::user()->id == $profile_owner_details->id):
        		$message = "his / her";
            else:
            	$message = $profile_owner_details->name;
            endif;
            $notification_message        = Auth::user()->name . ' like your answer posted on ' .$message .' forums question';
        else:
            $notification_message        = 'Ananymous like your answer posted on ' .$profile_owner_details->name .' forums question';
        endif;

        $notification_link              = URL::to('/forums/'.$career_advisor_answer_comment->forum_question_id .'/'.$career_advisor_answer_comment->forum_question->slug);
        $career_advisor_image           = (Auth::check()) ?  (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg') : asset('/front/images/blog1.jpg') ;

        //send the notification 
        $comment_owner_details->notify(new CommentLikeNotification($notification_message,$notification_link,$career_advisor_image));

        return response()->json(array('status'=>'success','total_likes' => ($current_like_counter + 1)),200);




    }


    /**
     * increase the like counter of the forum question
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Http\Respone
     *
     */

    public function increaseForumQuestionLike(Request $request){
        $forum_question_id  = $request->input('forum_question_id');
        //get forum details by the id
        $forum_question_details = ForumQuestion::findOrFail($forum_question_id);
        $like_counter                 = ($forum_question_details->like + 1);
        $forum_question_details->like = ($forum_question_details->like + 1);
        $forum_question_details->save();

        //return response back to the client
        return response()->json(array('status'=>'success','total_like' => quishi_convert_number_to_human_readable($like_counter)),200);
    }

}
