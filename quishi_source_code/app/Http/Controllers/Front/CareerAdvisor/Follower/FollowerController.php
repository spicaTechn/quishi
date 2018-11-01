<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Follower;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Follower;
use App\User;
use DB;

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

        //follow the user 

        //send the notification to the career advisor about the logged in user has followed you
    }


    /**
    * function to unfollow the career advisor by the logged in career advisor
    * 
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function unfollowCareerAdvisor($id){

        //get the profile details of the clicked 


        //logged in user should be remove from the follower list


        //send the notification to the career advisor about the logged in user has unfollowed you 

    }
}
