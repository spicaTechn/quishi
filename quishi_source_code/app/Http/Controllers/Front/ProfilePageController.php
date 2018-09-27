<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\CareerAdvisor\BaseCareerAdvisorController;
use App\Page;
use App\PageDetail;
use App\User;
use DB;
use App\Model\UserProfile;

class ProfilePageController extends BaseCareerAdvisorController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user     = User::where('logged_in_type','0')->get();
        //$user_tag = User::with('tags')->where('logged_in_type','0')->get();
        //echo "<pre>";print_r($user-); echo "</pre>";exit;
        return view('front.profile')->with(array(
            'site_title'     => 'Quishi',
            'page_title'     => 'Profile',
            'users'          => $user,

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

        $user_single = User::find($id);
        $questions   = $this->getCurrentUserCareer($user_single->id);
        //echo "<pre>"; print_r($questions); echo "</pre>";exit;
        $total_views = $user_single->user_profile->profile_views;
        $profile_view = ($total_views==0) ? $total_views+1 : $total_views;

        $i =0;
        foreach ($questions as $question) {
         $questions_id = $question['question_id'];
         $answers = DB::table('answers')->where('question_id',$question['question_id'])->where('user_id',$id)->select('content')->first();
         $questions[$i]['answer'] = $answers->content;
         $i++;
        }

        //echo "<pre>"; print_r($questions); echo "</pre>";exit;

        return view('front.single-pages.single-profile')->with(array(
            'site_title'     => 'Quishi',
            'page_title'     => 'View Profile',
            'user'           => $user_single,
            'questions'      => $questions,
            'profile_view'   => $profile_view

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
        $user_id     = $request->user_profile_id;
        $total_likes = $request->input('total_likes');

        $user  = User::find($user_id);

        //$total_likes =
        $user_like = UserProfile::where('user_id',$user_id)->firstOrFail();
        $user_like->total_likes = $total_likes;
        //echo "<pre>"; print_r($user_like); echo "</pre>";exit;
        $user_like->save();

        return response()->json(array('status'=>'success','result'=>'successfully liked user profile'),200);
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
