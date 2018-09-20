<?php

namespace App\Http\Controllers\Front\CareerAdvisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,DB;
use App\User;
use App\Model\UserProfile;
use App\Model\Career;

class CareerAdvisorController extends Controller
{

    protected $user_profile = "";
    protected $career = array();

    protected $user_career = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Career $career){
        $this->career    = Career::where('parent','<=',0)
                            ->get();
    }
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

    public function profile()
    {
        return view('front.career-advisor.my-profile');
    }

    public function profileLogin()
    {
        return view('front.career-advisor.my-profile-login');
    }
    public function profileAccount()
    {
        return view('front.career-advisor.profile-account');
    }
    public function profileSetupOne()
    {
        if(Auth::user()->user_profile()->count() > 0){
            if(Auth::user()->user_profile->profile_setup_steps == '1'){
                return redirect()->route('profile.setup.step2')->with([
                    'industries'     => $this->career
                ]);
            }
        }
        
        return view('front.career-advisor.profile-setup-1');
    }


    /**
    * function to store the user information if the data was set
    *
    *
    *
    **/

    public function profileSetupTwo(Request $request)
    {
        //redirect to the third page if the user filled in the step two
        if(Auth::user()->user_profile()->count() > 0){
            if(Auth::user()->user_profile->profile_setup_steps == '2'){
                return redirect()->route('profile.setup.step3');
            }
        }
        $redirect_to_origin = false;
        $redirect_message   = '';
        if($request->has('_token')){
            //need to store the first setup data in the db
            $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255',
            'address'       => 'required',
            'age_group'     => 'required'
            ])->validate();

            //validation passed !!
            //upload the user image if have 
            $user = Auth::user();
            if($request->hasFile('user_image')){
                //need to upload the image in the directory and store the path in the db

                //$user_profile->image_path = 'image_name';
            }
            
                //need to insert the data in the db
                $this->user_profile               = new UserProfile();
                $this->user_profile->first_name  = $request->input('name');
                $this->user_profile->last_name   = '';
                $this->user_profile->location    = $request->input('address');
                $this->user_profile->age_group   = $request->input('age_group');
                $this->user_profile->image_path  = ($request->hasFile('user_image')) ? $user_profile_image_path : '';
                $this->user_profile->description = ($request->has('description')) ? $request->input('description') : '';
                $this->user_profile->user_id     = Auth::user()->id; 
                $this->user_profile->profile_setup_steps = '1';
                if($this->user_profile->save() <= 0){
                    $redirect_to_origin = true;
                    $redirect_message   = "Cannot update the record, please try again later on!!";
                }
               
            //redirect to same page if error occurs
            if($redirect_to_origin):
                 return redirect()->route('profile.setup.step1')
                                    ->with([
                                        'redirect_message'  => $redirect_message
                                    ]);
            else:
                return view('front.career-advisor.profile-setup-2')->with([
                    'industries'      => $this->career
                ]);
            endif;

        }else{
            return view('front.career-advisor.profile-setup-2')->with([
                    'industries'      => $this->career
                ]);
        }

        
    }
    public function profileSetupThree(Request $request)
    {

        //need to show the question as per the job title
        
        if($request->has('_token')){
            //first has been submit thus stored the submitted in the db

            echo '<pre>';
            print_r($request->all());
            echo '</pre>';
            exit;
            $user = Auth::user();
            if($user->user_profile()->count() > 0){
                //udpate the record in the db
                $data           = array(
                    'educational_level'   => $request->input('education'),
                    'faculty'             => $request->input('faculty'),
                    'salary_range'        => $request->input('salary'),
                    'job_experience'      => $request->input('job_experience'),
                    'skills'              => $request->input('skills'),
                    'profile_setup_steps' => '2'
                );


                DB::table('user_profile')->where('user_id',Auth::user()->id)
                                         ->update($data);

                //now need to update user career table to record the user job title

                if($request->has('job_title')){
                    //$user_career = new U
                    DB::table('user_career')->insert(array('user_id'=> Auth::user()->id,'career_id'=>$request->input('job_title'),'created_at'=> now(),'updated_at'=> now()));
                }

            }
            //$this->user_profile  = 
        }
        return view('front.career-advisor.profile-setup-3');
    }
    public function questionAdminReview()
    {
        return view('front.career-advisor.question-admin-review');
    }
    public function questionAnsEdit()
    {
        return view('front.career-advisor.question-ans-edit');
    }



    /**
    *
    * function to get the job by parent parent industry
    *
    * @param Illuminate\Http\Request
    * @return json object
    *
    */

    public function getJobByIndustryId(Request $request){
        //
        $job_by_industry_id = Career::where('parent',$request->input('industry_id'))->select('id','title')->get();
        $return_html = "";
        if($job_by_industry_id->count() > 0){
            foreach($job_by_industry_id as $job_title){
                $return_html .= '<option value="'.$job_title->id.'">'.ucwords($job_title->title).'</option>';
            }
            
        }   
        return response()->json(array('status'=>'success','result'=>$return_html),200);
    }


    /**
    *
    *
    *
    *
    *
    */


    protected function getCurrentUserCareer($id){
        
        $user_career_ids = DB::table('user_career')->where('user_id',$id)->get();

        foreach($user_career_ids as $user_career_id){
            $user_careers  = Career::all();

            //get the question related to the career and having the all 
            foreach($user_careers as $user_career){
                echo '</pre>';
                print_r($user_career->questions()->count());
                echo '</pre>';
                exit;
            }
        }
    }
}
