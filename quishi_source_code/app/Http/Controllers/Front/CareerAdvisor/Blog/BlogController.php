<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Post;
use Carbon\Carbon;
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
        $career_advisior_blogs    = Post::where('user_id',$logged_in_career_advisor)->orderBy('published_date','desc')->paginate(3);

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
        $this->post->published_date = Carbon::parse($request->input('_blog_published_date'))->format('Y-m-d');

        //check for the images for not
        if($request->has('_featured_image')){
            //need to save the image first
            $blog_image                 = $request->file('_featured_image');
            $name                       = time() . '.'.$blog_image->getClientOriginalExtension();
            $blog_image->move($this->destination_path,$name);
            $this->post->image_path     = $name;
        }

        $this->post->save();

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
        $this->post->published_date = Carbon::parse($request->input('_blog_published_date'))->format('Y-m-d');

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
        //
    }
}
