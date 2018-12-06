<?php

namespace App\Http\Controllers\Admin\Cms\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;
use Input,Session,Hash,Image,Validator,File,Auth;
use App\Libraries\Filehelpers;
use App\Model\Post;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $image_path='front/images/blogs';

    public function index()
    {

        $blogs   = Post::where('type','2')->get();
        //getting all blog and showing in admin page blog view
        return view('admin.cms.blog.blog')
                ->with(array(
                    'site_title'          =>'Quishi',
                    'page_title'          =>'Blog',
                    'all_blogs'           => $blogs,
                    )
                );
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


        //need to store in the post table

        $post   = new Post();
        $post->title          = $request->input('blog_title');
        $post->slug           = str_slug($request->input('blog_title'));
        $post->content        = $request->input('blog_description'); 
        $post->abstract       = $request->input('blog_abstract');;
        $post->published_date = Carbon::parse($request->input('date'))->format('Y-m-d h:i:s');
        $post->type           = '2';
        $post->user_id        = Auth::user()->id;

        if($request->hasFile('blog_image')) {
            $image = $request->file('blog_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = $this->image_path;
            $image->move($destinationPath, $name);

            $post->image_path   = $name;
        }

        $post->save();
        return response()->json(array('status'=>'success'),200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //getting all blog and showing in admin page where blog is exist

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
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
        //getting blog by id

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //finding content bu id and deleting
        $blog_id        = $request->delete_id;
        $page_detail_id = $request->page_detail_delete_id;

        $blogs  = Page::with('page_detail')->find($blog_id);

        foreach ($blogs->page_detail as $blog) {
            # code...
            //echo "<pre>"; print_r($blog['id']); echo "</pre>";exit;

            $page_detail = PageDetail::find($blog['id']);
            $page_detail->delete();

            $blog_detail = unserialize($blog->meta_value);
            $path=$this->image_path.'/'.$blog_detail['image'];
            File::delete($path);
        }
        $blogs->delete();

        return response()->json(array('status'=>'success','result'=>'successfully delete blog from  the quishi system'),200);
    }





    public function editBlog(Request $request, $id)
    {

        $blogs  =  Post::findOrFail($id);

        $date  = Carbon::parse($blogs->published_date)->format('M d, Y');
        return response()->json(array('result'=>$blogs,'published_date'=>$date,'status'=>'success'),200);

    }

    public function updateBlog(Request $request, $id)
    {

       
        $post   = Post::findOrFail($id);
        $post->title          = $request->input('blog_title');
        $post->slug           = str_slug($request->input('blog_title'));
        $post->content        = $request->input('edit_blog_description'); 
        $post->abstract       = $request->input('blog_abstract');;
        $post->published_date = Carbon::parse($request->input('date'))->format('Y-m-d h:i:s');
        $post->type           = '2';
        $post->user_id        = Auth::user()->id;

        if($request->hasFile('blog_image')) {
            $image = $request->file('blog_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = $this->image_path;
            $image->move($destinationPath, $name);

            $post->image_path   = $name;
        }

        $post->save();
        return response()->json(array('status'=>'success','result'=>'successfully updated blog in the quishi system'),200);


    }
}
