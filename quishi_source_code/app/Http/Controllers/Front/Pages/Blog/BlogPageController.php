<?php

namespace App\Http\Controllers\Front\Pages\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;
use App\User;
use App\Model\UserProfile;
use Auth;


class BlogPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blog         = Page::with('page_detail')->where('slug','blog')->get();
        //echo "<pre>"; print_r($blog); echo "</pre>";exit;

        return view('front.pages.blog.blog')->with(array(
             'site_title'    =>    'Quishi',
             'page_title'    =>    'Blog',
             'blogs'         =>    $blog
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
        //

        $blog = Page::with('page_detail')->find($id);
        //$user = Auth::id();
        //echo "<pre>"; print_r($blog); echo "</pre>";exit;

        foreach ($blog->page_detail as $blog_details) {
           $blog_details_value = unserialize($blog_details->meta_value);
           //echo "<pre>"; print_r($blog_details_value); echo "</pre>";exit;
        }


        return view('front.pages.single-pages.single-blog')->with(array(
            'site_title'   => 'Quishi',
            'page_title'   => 'Single Blog',
            'blog'         => $blog,
            'blog_details' => $blog_details_value,

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
        $page_id = $request->page_id;
        //get the total page like 

        $page_details = Page::findOrFail($page_id);
        $current_page_like = $page_details->total_likes;
        $page_details->total_likes = $page_details->total_likes + 1;
        $page_details->save();


        //return response

        return response()->json(array('status'=>'success','result'=>($current_page_like + 1)));


    }
}
