<?php

namespace App\Http\Controllers\Admin\Cms\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;
use Input,Session,Hash,Image,Validator,File,Auth;
use App\Libraries\Filehelpers;

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
        //getting all blog and showing in admin page blog view
        $blogs = Page::with('page_detail')->where('slug','blog')->get();
        $blog = $blogs ?? '';
        return view('admin.cms.blog.blog')
                ->with(array(
                    'site_title'          =>'Quishi',
                    'page_title'          =>'Blog',
                    'all_blogs'           => $blog,
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
        //storing blog content to database
        //echo "<pre>";print_r($request->all()); echo "</pre>";exit;
        $blog              = new Page();
        $blog->title       = $request->input('blog_title');
        $blog->content     = $request->input('blog_description');
        $blog->slug        = 'blog';
        $blog->user_id     = 1;
        $blog->save();


        if($request->hasFile('blog_image')) {
            $image = $request->file('blog_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = $this->image_path;
            $image->move($destinationPath, $name);
        }

        $new_blog = array();

        $new_blog['abstract']       = $request->input('blog_abstract');
        $new_blog['facebook']       = $request->input('facebook');
        $new_blog['twitter']        = $request->input('twitter');
        $new_blog['instragram']     = $request->input('instragram');
        $new_blog['date']           = $request->input('date');
        $new_blog['image']          = $name;

        $new_blog_serialize      = serialize($new_blog);

        $page_detail             = new PageDetail();
        $page_detail->page_id    = $blog->id;
        $page_detail->meta_key   = 'blog';
        $page_detail->meta_value = $new_blog_serialize;

        $blog->page_detail()->save($page_detail);

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
        $blogs  = Page::with('page_detail')->find($id);

        foreach ($blogs->page_detail as $blog) {
            # code...
            // echo "<pre>"; print_r($blog->meta_value); echo "</pre>";exit;
            $blog_detail = unserialize($blog->meta_value);

        }

        $new_blog_detail              = array();

        $new_blog_detail['title']       = $blogs->title;
        $new_blog_detail['description'] = $blogs->content;

        $new_blog_detail['facebook']   = $blog_detail['facebook'];
        $new_blog_detail['twitter']    = $blog_detail['twitter'];
        $new_blog_detail['instragram'] = $blog_detail['instragram'];
        $new_blog_detail['date']       = $blog_detail['date'];
        $new_blog_detail['image']      = $blog_detail['image'];
        $new_blog_detail['abstract']   = $blog_detail['abstract'];

        //echo "<pre>"; print_r($new_blog_detail); echo "</pre>";exit;


        return response()->json(array('result'=>$new_blog_detail,'status'=>'success'),200);

    }

    public function updateBlog(Request $request, $id)
    {
        $blog_id        = $request->blog_id;
        $page_detail_id = $request->page_detail_id;
        $name           = '';
        $found_image    = false;

        $blog              = Page::find($blog_id);
        foreach ($blog->page_detail as $blogs) {
            # code...
            // echo "<pre>"; print_r($blog->meta_value); echo "</pre>";exit;
            $blog_detail = unserialize($blogs->meta_value);

        }
        //echo "<pre>"; print_r($blogs['id']); echo "</pre>"; exit;

        $blog->title       = $request->input('blog_title');
        $blog->content     = $request->input('blog_description');
        $blog->slug        = 'blog';
        $blog->user_id     = 1;
        $blog->save();


        if($request->hasFile('blog_image')) {
            $image = $request->file('blog_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = $this->image_path;
            $image->move($destinationPath, $name);
            $found_image   = true;
            if($blogs['id'])
            {
                $path=$this->image_path.'/'.$blog_detail['image'];
                File::delete($path);
            }


        }

        if(!$found_image){
            $name = $blog_detail['image'];
        }


        $blog_detail['abstract']       = $request->input('blog_abstract');
        $blog_detail['facebook']       = $request->input('facebook');
        $blog_detail['twitter']        = $request->input('twitter');
        $blog_detail['instragram']     = $request->input('instragram');
        $blog_detail['date']           = $request->input('date');
        $blog_detail['image']          = $name;

        $new_blog_serialize         = serialize($blog_detail);
        $page_detail             = PageDetail::find($page_detail_id);
        $page_detail->meta_key   = 'blog';
        $page_detail->page_id    = $blog_id;
        $page_detail->meta_value = $new_blog_serialize;

        $page_detail->save();

        return response()->json(array('status'=>'success','result'=>'successfully updated blog in the quishi system'),200);


    }
}
