<?php

namespace App\Http\Controllers\Front\Pages\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\CareerAdvisor\BaseCareerAdvisorController;
use App\Page;
use App\PageDetail;
use App\User;
use DB;
use App\Model\UserProfile;
use App\Model\Education, App\Model\Career;

class ProfilePageController extends BaseCareerAdvisorController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $offset   = 0;
    protected $per_page = 6;

    public function index(Request $request)
    {
        //

        if($request->has('search')):
            
        else:
            $user     = User::where('logged_in_type','0')->take($this->per_page)->get();
            $record   = $user->count();
            $show_more= false;
            if($user){
                if($this->per_page = $record){
                    $show_more = true;
                }
            }
        endif;
        //load the education

        $career    = Career::where('parent','=','0')->get();
        
        //load industry

        //$user_tag = User::with('tags')->where('logged_in_type','0')->get();
        //echo "<pre>";print_r($user); echo "</pre>";exit;
        return view('front.pages.profile.profile')->with(array(
            'site_title'     => 'Quishi',
            'page_title'     => 'Profile',
            'users'          => $user,
            'show_more'      => $show_more,
            'industries'     => $career,        

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


        $total_views = $user_single->user_profile->profile_views;
        $profile_view = $total_views+1;
        $user_views = UserProfile::where('user_id',$user_single->id)->firstOrFail();
        $user_views->profile_views = $profile_view;
        //echo "<pre>"; print_r($user_like); echo "</pre>";exit;
        $user_views->save();
        //echo "<pre>"; print_r($profile_view); echo "</pre>";exit;


        $i =0;
        foreach ($questions as $question) {
         $questions_id = $question['question_id'];
         $answers = DB::table('answers')->where('question_id',$question['question_id'])->where('user_id',$id)->select('content')->first();
         $questions[$i]['answer'] = $answers->content;
         $i++;
        }

        //echo "<pre>"; print_r($questions); echo "</pre>";exit;

        return view('front.pages.single-pages.single-profile')->with(array(
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

    public function loadMoreCareer(Request $request)
    {


        $result = $request->record;

        $new_data     = User::where('logged_in_type','0')->skip(2*$result)->take(2)->get();
        $record   = $new_data->count();
        $loadmore= false;
        //echo "<pre>"; print_r($user); echo "</pre>";exit;
        if($new_data){
            if($this->per_page = $record){
                $loadmore = true;
            }
        }

        $returnHTML = view('front.pages.profile.loadmore')->with(array(
            'site_title'      => 'Quishi',
            'page_title'      => 'Profile',
            'users'           => $new_data,
            'show_more'       => $loadmore,
            'record_increment'=> $result

        ))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));


    }


}
