<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $career_advisior = User::where('logged_in_type',1)->get();
        return view('admin.user.index')
                ->with([
                        'site_title'                =>'Quishi',
                        'page_title'                =>'User',
                        'career_advisiors'          => $career_advisior
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
    * function to get the career advisior
    *
    * @param void
    * @return Illuminate\Http\Response
    *
    *
    *
    */


    public function getCareerAdvisor(){
        $career_advisiors   = User::with('user_profile','careers')->where('logged_in_type',1)->select('users.*');
        return Datatables($career_advisiors)
               
               ->addColumn('job_title',function($career_advisior){
                   
                    return $career_advisior->careers->map(function($job_title) use($career_advisior){
                                return ucwords($job_title->title);
                    })->implode(','); 
               })
               ->addColumn('user_image',function($career_advisior){
                    if($career_advisior->user_profile->image_path != "")
                        return asset('/front/images/profile/'.$career_advisior->user_profile->image_path);
                    else
                        return asset('/admin_assets/assets/images/widget/user2.png');
               })
               ->addColumn('status',function($career_advisior){
                    $status = $career_advisior->user_profile->status;
                    return ($status) ? 'Active' : 'Inactive';
               })
               ->addColumn('profile_views_count',function($career_advisior){
                    //return $career_advisior->user_profile->profile_views;
                    return '0';
               })->addColumn('action',function($career_advisior){
                    $return_html = " ";
                    $return_html .= '<a href="#" 
                                          class="m-r-15 text-muted view-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="View More" 
                                          data-user-id="'.$career_advisior->id.'">
                                          <i class="icofont icofont-business-man-alt-3"></i>
                                        </a>

                                        <a href="#" 
                                          class="m-r-15 text-muted review-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="Write Review" 
                                          data-user-id="'.$career_advisior->id.'">
                                          <i class="icofont icofont-comment"></i>
                                        </a>

                                        <a href="#" 
                                          class="m-r-15 text-muted deactivate-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="Deactivate" 
                                          data-user-id="'.$career_advisior->id.'">
                                          <i class="icofont icofont-ui-lock"></i>
                                        </a>

                                        <a href="#" 
                                          class="text-muted activate-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="Activate" 
                                          data-user-id="'.$career_advisior->id.'">
                                          <i class="icofont icofont-ui-check"></i>
                                        </a>';
                return $return_html;
               })
               ->make(true);

    }
}
