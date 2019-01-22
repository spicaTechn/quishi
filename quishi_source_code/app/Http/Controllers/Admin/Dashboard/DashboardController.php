<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Question, App\Model\Career;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    protected $total_registered_users = 0;
    protected $total_questions,$total_industry = 0;
    protected $start_of_month,$end_of_month,$current_month_registered_users,$common_tags=array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $this->start_of_month = new Carbon('first day of this month');
        $this->end_of_month   = new Carbon('last day of this month');

        //current month
        $date =  Carbon::now();
        $date =  $date->format('M'); // July
       
        $this->getTotalRegisteredUsers();
        $this->getTotalQuestions();
        $this->getTotalIndustry();
        $this->getMostUsedTags();
        //get the current month
        return view('admin.dashboard.index')->with([
              'site_title'                          =>'Quishi', 
              'page_title'                          =>'Dashboard',
              'total_user'                          => $this->total_registered_users,
              'total_question'                      => $this->total_questions,
              'total_industry'                      => $this->total_industry,
              'current_month_registered_users'      => $this->current_month_registered_users,
              'common_tags'                         => $this->common_tags,
              'date'                                => $date,
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
    *
    * get the total number of registered users
    *
    * @param void
    * @return  void
    *
    *
    */

    protected function getTotalRegisteredUsers(){

        $this->total_registered_users  = User::all()->where('logged_in_type','0')->count();

        //get monthly registered users
        $this->current_month_registered_users = User::whereBetween('created_at',[$this->start_of_month,$this->end_of_month])
                                                   ->where('logged_in_type','0')
                                                   ->count();
        
    }


    /**
    *
    * get the total number of questions
    *
    * @param void
    * @return  void
    *
    *
    */

    protected function getTotalQuestions(){
        $this->total_questions = Question::count();
    }



    /**
    * get total number of careers where parent is equal to zero
    *
    * @param void
    * @return void
    */


    protected function getTotalIndustry(){
        $this->total_industry   = Career::where('parent',0)->count();
    }


    /**
    * get total number of careers where parent is equal to zero
    *
    * @param void
    * @return void
    */


    protected function getTotalIndustry1(){
        $this->total_industry   = Career::where('parent',0)->count();
    }



    /**
    * get most used 6 tags 
    *
    * @param void
    * @return void
    *
    *
    *
    */

    protected function getMostUsedTags(){

        $common_tags    = DB::table('tags')
                            ->join('user_tag','user_tag.tag_id','=','tags.id')
                            ->select(DB::raw('count(user_tag.tag_id) as tag_number'),'tags.title','tags.id')
                            ->groupBy('tags.id','tags.title')
                            ->orderBy(DB::raw('tag_number'),'DESC')
                            ->limit(6)
                            ->get();
        $this->common_tags = $common_tags;
    }



    public function showMonthlyUserRegistrationRatio(){
        //get the current year user ratio
        $user_registration_ratio  = DB::select("select monthname(created_at) as year, count(users.id) as value from users where YEAR(created_at) = YEAR(CURDATE()) group by monthname(created_at) ORDER BY FIELD(year,'January','February','March','April','May','June','July','August','September','October','November','December')");


        return response()->json(array('status'=>'success','result'=>$user_registration_ratio),200);
    }



}
