<?php

namespace App\Http\Controllers\Front\Pages\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Comment;
use Auth;

use App\Notifications\NewCommentPostedNotification;

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

        $return_html   = view('front.pages.profile.comment')->with([
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
            $notification_link              = URL::to('/blog/'.$blog_id);  //need to add #id of the currently posted comment

            $profile_owner->notify(new NewCommentPostedNotification($notification_message,$notification_commentor_image,$notification_link) );
        endif;

        //$notification_link              = 
        //get the profile of the comment poster and this is currently logged in career advisor
        $comment_posted_by   = Auth::user();

        //get other commentors who have posted comment already
        $other_commentors    = Comment::where('post_id',$blog_id)
                                      ->where('user_id',$profile_id)
                                      ->whereNotIn('posted_by',array($profile_id,$this->recent_blog_comment->posted_by))
                                      ->select('posted_by')
                                      ->get();
        //send notification to the other commentors if any

        foreach($other_commentors as $other_commentor):
            $other_commentor_details       = User::findOrFail($other_commentor->posted_by);
            //check for the profile question owner
            if($other_commentor_details->id != $profile_id):
                $notification_message          = Auth::user()->name .' also commented on ' .$profile_owner->name .' blog ' . $this->recent_blog_comment->post->title  . '"';
            else:
                $notification_message          = Auth::user()->name .' also commented on his blog "' . $this->recent_blog_comment->post->title  . '"';
            endif;
            $notification_commentor_image  = (Auth::user()->user_profile->image_path != "") ?  asset('/front/images/profile') .'/'. Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg');
            $notification_link             = URL::to('/blog/'.$blog_id); //need to add the #id of the comment that has been posted

            $other_commentor_details->notify(new NewCommentPostedNotification($notification_message,$notification_commentor_image,$notification_link));
        endforeach;
    }





}
