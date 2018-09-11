<?php

namespace App\Http\Controllers\Admin\Cms\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\About;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.cms.pages.pages')
                ->with(array('site_title'=>'Quishi', 'page_title'=>'Pages'));
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


    // updating about page top section
    public function aboutUpdate(Request $request, $about)
    {
        $this->about        =   About::find($about);
        $about_title        =   $this->about->about_title = $request->input('about_title');
        $about_description  =   $this->about->about_description = $request->input('about_description');

        $this->about->save();

        // send the ajax reposne
        return response()->json(array('status'=>'success'),200);

    }
}
