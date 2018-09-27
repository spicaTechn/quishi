<?php

namespace App\Http\Controllers\Front\Pages\About;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;

class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //displaying view in front page with dyanamic data
        $abouts         = Page::where('slug','about-us')->first();
        $about_image    = PageDetail::where('page_id',$abouts->id)
                                   ->where('meta_key', 'about-us-image')
                                   ->first();
        $our_team       =   PageDetail::where('page_id',$abouts->id)
                                   ->where('meta_key', 'our-team')
                                   ->first();
        $our_team_unserialize   = unserialize($our_team->meta_value);

        return view('front.pages.about.about')
                    ->with(array(
                        'site_title'          =>    'Quishi',
                        'page_title'          =>    'About',
                        'about'               =>    $abouts,
                        'about_image'         =>    $about_image,
                        'our_teams'           =>    $our_team_unserialize,

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
}
