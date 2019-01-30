<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Post;
use Carbon\Carbon;
use App\Model\Follower;
use App\Notifications\NewBlogCreatedNotification;
use App\User, App\Model\Blog;

class BlogController extends Controller
{

    protected $post;
    protected $destination_path = "front/images/blogs";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $logged_in_career_advisor = Auth::user()->id;
        $career_advisior_blogs    = Post::where('user_id',$logged_in_career_advisor)->orderBy('published_date','desc')->paginate(6);

        return view('front.career-advisor.blog.index')->with([
            'blogs'         => $career_advisior_blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('front.career-advisor.blog.add');
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

        $this->post                 = new Post();
        $this->post->title          = $request->input('blog_title');
        $this->post->slug           = str_slug($request->input('blog_title'));
        $this->post->user_id        = Auth::user()->id;
        $this->post->content        = $request->input('blog_description');
        $this->post->abstract       = $request->input('blog_abstract');
        $this->post->published_date = Carbon::now();

        //check for the images for not
        if($request->has('_featured_image')){
            //need to save the image first
            $blog_image                 = $request->file('_featured_image');
            $name                       = time() . '.'.$blog_image->getClientOriginalExtension();
            $blog_image->move($this->destination_path,$name);
            $this->post->image_path     = $name;
        }

        $this->post->save();

        //after saving send the notification to the currently logged in career advisor followers
        $blog_details     =  Post::findOrFail($this->post->id);
        $followers        = Auth::user()->followers;

        foreach($followers as $follower){
            $notifiy_career_advisor  = User::findOrFail($follower->pivot->follower_id);
            $notifiy_career_advisor->notify(new NewBlogCreatedNotification($blog_details));
        }



        return redirect()->route('profile.blog.index');
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
        $this->post   = Post::findOrFail($id);
        return view('front.career-advisor.blog.edit')->with(array('blog_detail' => $this->post));
        
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

        $this->post   = Post::findOrFail($id);
        $this->post->title          = $request->input('blog_title');
        $this->post->slug           = str_slug($request->input('blog_title'));
        $this->post->user_id        = Auth::user()->id;
        $this->post->content        = $request->input('blog_description');
        $this->post->abstract       = $request->input('blog_abstract');
        //$this->post->published_date = Carbon::parse($request->input('_blog_published_date'))->format('Y-m-d');

        if($request->has('_featured_image')){
            //need to save the image first
            $blog_image                 = $request->file('_featured_image');
            $name                       = time() . '.'.$blog_image->getClientOriginalExtension();
            $blog_image->move($this->destination_path,$name);

            //remove the old image
            if($this->post->image_path != " "):
                //remove the image from the server
                 $file = $_SERVER['DOCUMENT_ROOT'].'/quishi/front/images/blogs/'.$this->post->image_path;
                if(file_exists($file)):
                     \File::delete($file);
                endif;
            endif;

            $this->post->image_path     = $name;
        }

        $this->post->save();
        return redirect()->route('profile.blog.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->post   = Post::findOrFail($id);
        $image_path   = $this->post->image_path;

        //delete the image 
        if($image_path != " " &&   $this->post->delete()):
            $file = $_SERVER['DOCUMENT_ROOT'].'/quishi/front/images/blogs/'.$image_path;
            if(file_exists($file)):
                 \File::delete($file);
            endif;
        endif;

        return response()->json(array('status'=>'success','message' => 'Blog has been deleted successfully!!'),200);
    }
}
