<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use App\PageDetail;
use App\User;
use App\Model\UserProfile;
use App\Model\Tag;
use DB;


class MainPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetching contact data to show in footer section

        $blogs = Page::with('page_detail')->where('slug','blog')->orderBy('id', 'desc')->limit(2)->get();
        $blog  = $blogs ?? '';
        $user_profiles = UserProfile::orderBy('profile_views','desc')->take(3)->get();
        $service      = Page::where('slug','home')->get();
        $home_video = Page::where('slug','home-video')->first();

        return view('front.index')
                    ->with(array(
                            'site_title'          => 'Quishi',
                            'page_title'          => 'Home',
                            'blogs'               => $blog,
                            'users_profile'       => $user_profiles,
                            'services'            => $service,
                            'home_video'          => $home_video
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

    public function getSocialMediaData()
    {
        $contact          = Page::where('slug','contact-us')->first();
        $contact_social  = PageDetail::where('page_id',$contact->id)
                                        ->where('meta_key','contact-us')
                                        ->first();
        $contact_social_data = unserialize($contact_social->meta_value);
        //echo "<pre>";print_r($contact_social_data); echo "</pre>";exit;
        return $contact_social_data;

    }
}
