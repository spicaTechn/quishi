<?php

namespace App\Http\Controllers\Front\Pages\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;
use App\User;
use App\Model\UserProfile;
use Auth;
use App\Model\Post;
use Illuminate\Support\Facades\URL;

//notifications
use App\Notifications\BlogLikeNotification;

class BlogPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if($request->has('blog_title')):
            $blog = Post::where('type','1')
                        ->orderBy('published_date','desc')
                        ->where('title','like','%'.$request->input('blog_title') .'%')
                        ->paginate(9);
        else:
            $blog         = Post::where('type','1')
                                ->orderBy('published_date','desc')
                                ->paginate(9);
        endif;
        return view('front.pages.blog.blog')->with(array(
             'site_title'    =>    'Quishi',
             'page_title'    =>    'Blog',
             'blogs'         =>    $blog,
             'url'           =>    url('/blog')
        ));
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
        //storing blog content to database

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //check for the request type

        $blog_details = Post::findOrFail($id);
        return view('front.pages.single-pages.single-blog')->with(array(
            'site_title'   => 'Quishi',
            'page_title'   => 'Single Blog',
            'blog_details' => $blog_details,

        ));
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
    * function to increase the total like in the blog page when the user clicks the total like
    *
    * @param \Illuminate\Http\Request
    * @return \Illuminate\Http\Response
    *
    *
    **/

    public function page_like(Request $request){
        $post_id = $request->blog_id;
        //get the total page like 

        $page_details = Post::findOrFail($post_id);
        $current_page_like = $page_details->total_like_counts;
        $page_details->total_like_counts = $page_details->total_like_counts + 1;
        $page_details->save();
        
        //sends the notification
        $user   = User::findOrFail($page_details->user_id);
        if(Auth::check()):
            if($page_details->user_id != Auth::user()->id):
                //check for the admin 
                if($user->logged_in_type == '1'):
                else:
                    //send the notification for the career advisor only
                    $user->notify(new BlogLikeNotification($page_details));
                endif;

            endif;
        else:
            $user->notify(new BlogLikeNotification($page_details));
        endif;

        //return response
        return response()->json(array('status'=>'success','result'=>($current_page_like + 1)));


    }



    /**
     * function to show the list of the blog of the career advisior
     * @param int ($id)
     * @return \Illuminate\Http\Response
     */ 

    public function showCareerAdvisiorBlog(Request $request,$id){

        //need to check for the blog search as well

        if($request->has('blog_title')):
             $career_advisor_blogs = Post::where('user_id',$id)
                                         ->orderBy('published_date','desc')
                                         ->where('title','like','%'.$request->input('blog_title') .'%')
                                         ->paginate(9);
        else:
             $career_advisor_blogs = Post::where('user_id',$id)->orderBy('published_date','desc')->paginate(9);
        endif;

       return view('front.pages.blog.blog')->with([
                                                    'site_title'   => 'Quishi',
                                                    'page_title'   => 'Career Advisior Blogs',
                                                    'blogs'        => $career_advisor_blogs,
                                                    'url'          => url('/blog/careerAdvisor/'.$id.'/'.str_slug(User::find($id)->user_profile->first_name))
                                                ]);
    }


    /**
     * function to show the list of the media
     * @param \Illuminate\Http\Requset
     * @return \Illuminate\Http\Response
     *
     *
     */

    public function media(Request $request){

        if($request->has('blog_title')):
            $medias = Post::where('type','2')
                        ->orderBy('published_date','desc')
                        ->where('title','like','%'.$request->input('blog_title') .'%')
                        ->paginate(9);
        else:
        $medias = Post::where('type','2')
                      ->orderBy('published_date','desc')
                      ->paginate(6);
        endif;
        return view('front.pages.blog.blog')->with(array(
             'site_title'    =>    'Quishi',
             'page_title'    =>    'Blog',
             'blogs'         =>    $medias,
             'url'           =>    url('/media')
        ));
    }

}
