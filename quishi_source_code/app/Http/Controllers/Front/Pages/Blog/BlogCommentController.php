<?php

namespace App\Http\Controllers\Front\Pages\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Comment;
use Auth,URL;
use Carbon\Carbon;
use App\User;
use App\Model\Post;

use App\Notifications\NewCommentPostedNotification;
use App\Notifications\CommentLikeNotification;


class BlogCommentController extends Controller
{

    protected $recent_blog_comment;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * function to add new comment on the career advisor blog
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     *
     */

    public function createComment(Request $request)
    {

        $comment_parent         = $request->input('_parent_comment_id');
        $blog_id                = $request->input('_parent_post_id');
        $blog_career_advisor_id = $request->input('_blog_career_advisor_id');
        $message                = $request->input('_comment_message');
 
        if($request->has('_hide_name')):
            $type   = '1';
        else:
            $type   = '0';
        endif;
        

        //insert the new comment on the career advisor profile queries
        $blog_comment            = new Comment();
        $blog_comment->user_id   = $blog_career_advisor_id;
        $blog_comment->post_id   = $blog_id;
        $blog_comment->comment   = $message;
        $blog_comment->parent    = $comment_parent;
        $blog_comment->posted_by = Auth::user()->id;
        $blog_comment->posted_on = new Carbon();
        $blog_comment->type      = $type;
        $blog_comment->save();


        $recent_blog_comment          = Comment::findOrFail($blog_comment->id);
        $this->recent_blog_comment    = $recent_blog_comment;

        //count total number of comments here
        $all_comments        = Comment::where('post_id',$blog_id)->where('parent',0)->count();

  
        //send the notification 
        $this->sendNotificationAfterNewCommentPosted($blog_career_advisor_id,$blog_id);

        $return_html   = view('front.pages.profile.blog-comment')->with([
            'recent_comments'    => $recent_blog_comment
        ])->render();
        return response()->json(array('status'=>'success','result'=>$return_html,'total_comment'=>$all_comments),200);
    }



    /**
     * function to send the notification after the new comment posted on the career advisor profile
     * @param profile_id, answer_id
     * @return void
     *
     *
     */
    protected function sendNotificationAfterNewCommentPosted($profile_id,$blog_id){

        //get the question answered career advisor profile
        $profile_owner                  = User::findOrFail($profile_id);

        //no need to send the notification to the career advisor if he is commented on his profile
        if(Auth::user()->id  != $profile_owner->id):
            $notification_message           = Auth::user()->name . ' has commented on your blog "' . $this->recent_blog_comment->post->title .'"'; 
            $notification_commentor_image   = (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');
            $notification_link              = URL::to('/blog/'.$blog_id.'/'.$this->recent_blog_comment->post->slug.'#profile-comment-wrapper-'.$this->recent_blog_comment->id);  //need to add #id of the currently posted comment

            $profile_owner->notify(new NewCommentPostedNotification($notification_message,$notification_commentor_image,$notification_link) );
        endif;

        //$notification_link              = 
        //get the profile of the comment poster and this is currently logged in career advisor
        $comment_posted_by   = Auth::user();

        //get other commentors who have posted comment already
        $other_commentors    = Comment::where('post_id',$blog_id)
                                      ->where('user_id',$profile_id)
                                      ->whereNotIn('posted_by',array($profile_id,$this->recent_blog_comment->posted_by))
                                      ->where('parent',0)
                                      ->select('posted_by')
                                      ->distinct()
                                      ->get();
        //send notification to the other commentors if any

        foreach($other_commentors as $other_commentor):
            $other_commentor_details       = User::findOrFail($other_commentor->posted_by);
            //check for the profile question owner
            if(Auth::user()->id != $profile_owner->id):
                $notification_message          = Auth::user()->name .' also commented on ' .$profile_owner->name .' blog "' . $this->recent_blog_comment->post->title  . '"';
            else:
                $notification_message          = Auth::user()->name .' also commented on his blog "' . $this->recent_blog_comment->post->title  . '"';
            endif;
            $notification_commentor_image  = (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');
            $notification_link             = URL::to('/blog/'.$blog_id.'/'.$this->recent_blog_comment->post->slug.'#profile-comment-wrapper-'.$this->recent_blog_comment->id); //need to add the #id of the comment that has been posted

            $other_commentor_details->notify(new NewCommentPostedNotification($notification_message,$notification_commentor_image,$notification_link));
        endforeach;
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
        $career_advisor_answer_comment                    = Comment::findOrFail($request->input('_comment_id'));
        $this->posted_comment_profile                     = $career_advisor_answer_comment;
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
            $notification_message        = Auth::user()->name . ' like your comment posted on ' .$profile_owner_details->name .' blog';
        else:
            $notification_message        = 'Ananymous like your comment posted on ' .$profile_owner_details->name .' blog';
        endif;

        $notification_link              = URL::to('/blog/'.$career_advisor_answer_comment->post_id .'/'.$career_advisor_answer_comment->post->slug.'#profile-comment-wrapper-'.$career_advisor_answer_comment->id);
        $career_advisor_image           = (Auth::check()) ?  (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg') : asset('/front/images/blog1.jpg') ;

        //send the notification 
        $comment_owner_details->notify(new CommentLikeNotification($notification_message,$notification_link,$career_advisor_image));

        return response()->json(array('status'=>'success','total_likes' => ($current_like_counter + 1)),200);




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
        $parent_comment_details = Comment::findOrFail($parent_comment_id);
        $reply_content          = $request->input('_quishi_comment_reply');
        //comment posted by will be the currenlty logged in user
        $reply_posted_by        = Auth::user()->id;


        $this->profile_comment            =  new Comment();
        $this->profile_comment->post_id   = $parent_comment_details->post_id;
        $this->profile_comment->user_id   = $parent_comment_details->user_id;
        $this->profile_comment->comment   = $reply_content;
        $this->profile_comment->posted_by = $reply_posted_by;
        $this->profile_comment->parent    = $parent_comment_id;
        $this->profile_comment->type      = ($request->has('_hide_name_'.$parent_comment_id)) ? '1' : '0';
        $this->profile_comment->save();

        //no need to send the notification to the career advisor if he / she has commented on her profile comment
        if($parent_comment_details->posted_by   == $reply_posted_by){
            //career advisor sending the reply on his own profile own complete
        }elseif($parent_comment_details->user_id   == $parent_comment_details->posted_by){
            //comment parent is the career advisor comment
            $message                     = Auth::user()->name .' replied to your  comment published on your blog "' .$parent_comment_details->post->title .'"';
            $notification_link           = URL::to('/blog/'.$parent_comment_details->post_id.'/'.$parent_comment_details->post->slug."#blog-comment-reply".$this->profile_comment->id);
            $user_image                  =  (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');

            $parent_comment_details->user->notify(new NewCommentPostedNotification($message,$user_image,$notification_link));
        }else{
            //comment has been posted by the other commentors on other comment 
            if(Auth::user()->id != $parent_comment_details->user_id):
            $message                     = Auth::user()->name .' replied to your comment posted on "' . $parent_comment_details->user->name .'" blog "' .$parent_comment_details->post->title .'" ';
            else:
                $message                     = Auth::user()->name .' replied to your comment posted on his / her blog "' .$parent_comment_details->post->title .'" ';
            endif;
            $notification_link           = URL::to('/blog/'.$parent_comment_details->post_id.'/'.$parent_comment_details->post->slug."#blog-comment-reply".$this->profile_comment->id);
            $user_image                  =  (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');
            $parent_comment_details->comment_poster->notify(new NewCommentPostedNotification($message,$user_image,$notification_link));
        }



        //get the recently added comment reply
        $comment_reply_details          = Comment::findOrFail($this->profile_comment->id);
        $total_reply_on_current_comment = Comment::where('parent',$parent_comment_id)->count();
        $return_html  = view('front.pages.profile.blog-comment-reply')->with([
            'comment_reply'     => $comment_reply_details,
            'total_record'      => $total_reply_on_current_comment
        ])->render();

        //get the total number of reply on the parent comment
        

        return response()->json(array('status'=>'success','result'=>$return_html,'total_reply'=>$total_reply_on_current_comment),200);

    }






}
