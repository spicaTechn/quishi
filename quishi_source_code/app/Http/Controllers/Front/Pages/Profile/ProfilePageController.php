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
    protected $offset           = 0;
    protected $current_page     = 1;
    protected $per_page         = 4;
    protected $total_record     = 0;
    protected $job_title        = '';
    protected $user_location    = '';

    protected $search_users_list = "";
    protected $total_record_shown = 0;
    protected $view_render_user_list = array();


    public function index(Request $request)
    {
        

        //first set the current page showing
        if($request->has('current_page')):
            $this->offset       = $request->input('current_page') * $this->per_page;
            $this->current_page = $request->input('current_page') + 1;
        else:
            $this->offset       = 0;
            $this->current_page = 0;
        endif;

      

        $this->search_user_career_by_search_params($request);


        $career                 = Career::where('parent','>','1')->get();
        $career_location        = UserProfile::select(DB::raw('distinct(location) as address'))
                                              ->get();
        //return view
        return view('front.pages.profile.profile')->with(array(
<<<<<<< HEAD
            'site_title'            => 'Quishi',
            'page_title'            => 'Profile',
            'users_lists'           => $this->view_render_user_list,
            'show_more'             => ($this->total_record > ($this->per_page * ($this->current_page + 1))) ? true : false,
            'industries'            => $career,
            'total_record_shown'    => count($this->view_render_user_list),
            'current_page'          => 1,
            'career_locations'      => $career_location,
=======
            'site_title'     => 'Quishi',
            'page_title'     => 'Profile',
            'users'          => $user,
            'show_more'      => $show_more,
>>>>>>> refs/remotes/origin/master


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

        $this->current_page      = ($request->has('current_page')) ? $request->input('current_page') : 0 ;
        $this->offset            = ($this->per_page * $this->current_page);

        
        
        
        //call the function to render the data
        $this->search_user_career_by_search_params($request);


        //render the user list data into the blade before sending the response back to the browser
        $returnHTML = view('front.pages.profile.loadmore')->with(array(
            'site_title'            => 'Quishi',
            'page_title'            => 'Profile',
            'users_lists'           => $this->view_render_user_list,
            'per_page'              => $this->per_page,

        ))->render();

        $show_read_more     = ($this->total_record  > ($this->per_page  * ($this->current_page + 1))) ? true : false;

        //return the response back to the browser
        return response()->json(array(

                                    'success'                   => true,
                                    'html'                      =>$returnHTML,
                                    'read_more'                 =>$show_read_more,
                                    'total_record_shown'        => $this->total_record_shown
                                ),200);


    }


    /**
    *
    * function to search the user by the user search parameters by joing the tables
    * @param \Illuminate\Http\Request
    * 
    * @return object career_advisior_lists 
    *
    *
    **/

    protected function search_user_career_by_search_params($request){

        $order = $request->input('sort_order');
       
        $career_advisior_lists = DB::table('users')
                                    ->join('user_profile','users.id','=','user_profile.user_id')
                                    ->join('user_career','users.id','=','user_career.user_id')
                                    ->join('careers','user_career.career_id','=','careers.id')
                                    ->where('users.logged_in_type','0')
                                    //if the request has search by job title option
                                    ->where(function($query) use($request){
                                        if($request->has('industry') && !empty($request->input('industry'))):
                                                $job_title_id = $request->input('industry');
                                                $query->where('careers.id',$job_title_id);
                                        endif;

                                        if($request->has('search_by_job_title') && !empty($request->input('search_by_job_title'))):
                                             $job_title = $request->input('search_by_job_title');
                                             $query->where('careers.title','like',"%{$job_title}%");
                                        endif;
                                    })
                                    //if the request has search by location
                                    ->where(function($query) use($request){
                                        if($request->has('search_by_location') && !empty($request->input('search_by_location'))):
                                                $user_location = $request->input('search_by_location');
                                                $query->where('user_profile.location','like',"%{$user_location}%");
                                        endif;
                                    })

                                    //if the request has age_group
                                    ->where(function($query) use($request){
                                        if($request->has('age_group') && !empty($request->input('age_group'))):
                                                $age_group = $request->input('age_group');
                                                $query->where('user_profile.age_group',$age_group);

                                        endif;
                                    })

                                    //if the request has education
                                    ->where(function($query) use($request){
                                        if($request->has('education') && !empty($request->input('education'))):
                                                $education = $request->input('education');
                                                $query->where('user_profile.educational_level',"{$education}");
                                        endif;
                                    })->when($order,function($query,$order){


                                         switch($order){
                                            case 'asc':
                                              $query ->  orderBy('users.created_at','asc');
                                              break;
                                            case 'desc':
                                              $query -> orderBy('users.created_at','desc');
                                              break;
                                            case 'profile_desc':
                                              $query ->  orderBy('user_profile.total_likes','desc');
                                              break;
                                            case 'profile_asc':
                                              $query ->  orderBy('user_profile.total_likes','asc');
                                              break;
                                            case 'view_desc':
                                              $query -> orderBy('user_profile.profile_views','desc');
                                              break;
                                            case 'view_asc':
                                              $query -> orderBy('user_profile.profile_views','asc');
                                              break;
                                            default:
                                               $query -> orderBy('user_profile.profile_views','desc');
                                               break;


                                        }

                                    },function($query){
                                        $query->orderBy('user_profile.profile_views','desc');
                                    })
                                  
                                        
                                 
                        ;


        


        //switch through the sort_order
        


      $this->total_record    = $career_advisior_lists->count();

      $career_advisior_lists = $career_advisior_lists
                              ->skip($this->offset)
                              ->take($this->per_page)
                              ->select('user_profile.user_id','user_profile.first_name','user_profile.total_likes','user_profile.profile_views','user_profile.image_path','user_profile.description','user_profile.id')
                              ->get();
     
                        
       //returns value
       
       $this->search_users_list  = $career_advisior_lists;
       $this->render_data_to_the_view_required();
    
    }




    protected function render_data_to_the_view_required(){
        $i =0; 

        foreach($this->search_users_list    as $user_list){


            //render the user data from the search list
            $this->view_render_user_list[$i]['first_name']   = $user_list->first_name;
            $this->view_render_user_list[$i]['total_likes']  = $user_list->total_likes;
            $this->view_render_user_list[$i]['total_views']  = $user_list->profile_views;
            $this->view_render_user_list[$i]['user_id']      = $user_list->user_id;
            $this->view_render_user_list[$i]['user_image']   = $user_list->image_path;
            $this->view_render_user_list[$i]['descripiton']  = $user_list->description;


            //user eqloquent detail by the user id
            $user        = User::findOrFail($user_list->user_id);
            //get the user first career becuase a user can assign to only one job title for now
            $user_career = $user->careers()->first();

            $this->view_render_user_list[$i]['career']  = $user_career->title;

            //loop through each tags to get the tags
            $j = 0;
            // 
            foreach($user->tags()->take(3)->get() as $user_tag){
                $this->view_render_user_list[$i]['user_tag'][$j]['tag_title']  = $user_tag->title;
                $j++;
            }
            //increments the integer
            $i++;
        }

        //generate the number of total record show on the frontend

        $this->calculate_total_recored_shown();
    }


    /**
    *
    * function to calucate the total record shown current now
    *
    * @param void
    * @return void 
    *
    **/


    protected function calculate_total_recored_shown(){

        //get the current page show
        $this->total_record_shown  = $this->search_users_list->count() + ($this->current_page * $this->per_page);

    }


}
