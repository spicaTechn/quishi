<?php

namespace App\Http\Controllers\Front\Pages\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;

class BlogShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function show($user_id, $blog_id)
    {
        //
        $blog = Page::with('page_detail')
                        ->where('slug','blog')
                        ->where('user_id',$user_id)
                        ->find($blog_id);
        //echo"<pre>"; print_r($blog); echo"</pre>"; exit;

        foreach ($blog->page_detail as $blog_details) {
           $blog_details_value = unserialize($blog_details->meta_value);
           //echo "<pre>"; print_r($blog_details_value['image']); echo "</pre>";exit;
        }

        //echo"<pre>"; print_r($blogs); echo"</pre>"; exit;

        return view('front.pages.blog.blogshare')->with([
            'site_title'            =>'Quishi  Blog Share',
            'page_title'            =>'Blog Share',
            'blog'                  => $blog,
            'blog_details'          => $blog_details_value,
        ]);
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
}
