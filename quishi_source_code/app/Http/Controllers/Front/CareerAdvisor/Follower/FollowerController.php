<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Follower;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Follower;
use App\User;
use DB, Auth;
use App\Notifications\NewFollowersNotification;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        //get the follower of the currently logged in user along with the pagination
        $logged_in_career_advisor    = User::findOrFail(Auth::user()->id);
        $_career_advisor_followers   = $logged_in_career_advisor->followers()->paginate(4);
        return view('front.career-advisor.followers.index')->with([
            'followers'    => $_career_advisor_followers
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



    /**
    * function to follow the career advisor  by the logged in career advisor
    * @param int $id
    * @return \Illuminate\Http\Response
    *
    *
    */

    public function followCareerAdvisor($id){

        //get the follower details by the clicked id
        $following_career_advisor = User::find($id);

        //check the current logged in user is same as the following career advisor id
        if($following_career_advisor->id  == Auth::user()->id){
            return response()->json(array('status'=>'failed','message'=>'You cannot be the followers of your own'),200);
        }

        //check the  logged in users has already followed the career advisor
        if($following_career_advisor->followers()->where('follower_id', Auth::user()->id)->get()->count() >= 1){
            //logged in user has already 
            return response()->json(array('status'=>'failed','message'=>'You are already followers of '.$following_career_advisor->name,'name'=>$following_career_advisor->name),200);
        }

        //attach the data 
        $following_career_advisor_status = $following_career_advisor->followers()->attach(Auth::user()->id);
        //send the notification to the career advisor about the logged in user has followed you
        $user = User::find(Auth::user()->id);
        $following_career_advisor->notify(new NewFollowersNotification($user));
        //send the json success message
        return response()->json(array('status'=>'success','message'=> ucwords(Auth::user()->name) .' has started following ' .$following_career_advisor->name,'name'=>$following_career_advisor->name),200);
       

        

    }


    /**
    * function to unfollow the career advisor by the logged in career advisor
    * 
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function unfollowCareerAdvisor($id){

        //get the profile details of the clicked 

        $unfollowing_career_advisor   = User::find($id);
        if(!$unfollowing_career_advisor){
            return response()->json(array('status'=>'failed','message'=> 'Career Advisor does not exists in Quishi system'),200);
        }else{

            //detach the customer 
            $unfollowing_career_advisor->followers()->detach(Auth::user()->id);
            return response()->json(array('status'=>'success','message'=>'You have unfollow '.$unfollowing_career_advisor->name,'name'=>$unfollowing_career_advisor->name),200);
        }
       
        //send the notification to the career advisor about the logged in user has unfollowed you 

    }
}
