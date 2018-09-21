<?php

namespace App\Http\Controllers\Front\CareerAdvisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,DB;
use App\User;
use App\Model\UserProfile;
use App\Model\Career;
use App\Model\Tag;
use App\Model\Question, App\Model\Answer;

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

    public function profile(Request $reqeust)
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



    /**
    * function to check the user profile setup 
    *
    * @param void
    *
    * @return void / $this->career
    *
    *
    */ 

    public function profileSetupOne()
    {
        if(Auth::user()->user_profile()->count() > 0){
            if(Auth::user()->user_profile->profile_setup_steps == '1'){
                return redirect()->route('profile.setup.step2')->with([
                    'industries'     => $this->career
                ]);
            }elseif(Auth::user()->user_profile->profile_setup_steps == '2'){
                 return redirect()->route('profile.setup.step3')->with([
                    'industries'     => $this->career
                ]);
            }elseif(Auth::user()->user_profile->profile_setup_steps == '3'){
                 return redirect()->route('profile');
            }
        }
        return view('front.career-advisor.profile-setup-1');
    }




    /**
    * function to store the user information if the data was set
    *
    * @param Illuminate\Http\Request
    *
    **/

    public function profileSetupTwo(Request $request)
    {
        //redirect to the third page if the user filled in the step two
        if(Auth::user()->user_profile()->count() > 0){
            if(Auth::user()->user_profile->profile_setup_steps == '2'){
                return redirect()->route('profile.setup.step3');
            }elseif(Auth::user()->user_profile->profile_setup_steps == '3'){
                 return redirect()->route('profile');
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

        //first check for the profile status if completed then redirect to profile page
        if(Auth::user()->user_profile->profile_setup_steps == '3'){
            return redirect()->route('profile');
        }
        $current_user_question = $this->getCurrentUserCareer(Auth::user()->id);
        //need to show the question as per the job title
        if($request->has('_token')){
            //first has been submit thus stored the submitted in the db
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
                //now insert the tag in the db
                if($request->has('skills')){
                    $this->insertOrUpdateUserTag($request->input('skills'));
                }

            }
        }
        return view('front.career-advisor.profile-setup-3')->with([
            'user_questions'    => $current_user_question
        ]);
    }



    public function completeSetup(Request $request)
    {

        //save the user questions answer at the end of the profile setup

       $question_id   = $request->input('question_id');
       $answer_id     = $request->input('answer_id');

       for($i= 0; $i < count($question_id); $i++){
            //insert the record in the answer table 
          $answer               = new Answer();
          $answer->question_id  = $question_id[$i];
          $answer->user_id      = Auth::user()->id;
          $answer->total_likes  = 0;
          $answer->content      = $answer_id[$i];

          //now save in the asnwer table 
          $answer->save();
       }

       if(count($question_id) > 0){
        //now update the user profile table to make the profie setup as completed
        $user = User::find(Auth::user()->id);
        $user->user_profile()->update([
                        'profile_setup_steps'    => '3',
                        'profile_setup_status'  => '1'
                    ]);
       }

       //after that redirect to the profile route after the complete of the profile setup

       return redirect()->route('profile');
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
    * function to check the current user job title 
    *
    * @param user_id
    * @return array(user_question)
    *
    */


    protected function getCurrentUserCareer($id){
        
        $user_question = array();
        $i = 0;
        //now add question that is realted to all the industry / career / job title
        $question_for_all_careers = Question::where('assigned_career',"=",'1')
                                            ->where('status','1')
                                            ->get();

        if($question_for_all_careers->count() > 0){

            foreach($question_for_all_careers as $question_for_all_career):
                $user_question[$i]['question_id']      = $question_for_all_career->id;
                $user_question [$i]['question_title']  = $question_for_all_career->title;
                $user_question[$i]['question_type']    = $question_for_all_career->type;
                $i++;
            endforeach;
        }

        //get the current users job title if any
        $user_career_id = DB::table('user_career')->where('user_id',$id)->first();
        //loop throught the each job title to get the questions
        if($user_career_id):
            $user_career  = Career::where('id',$user_career_id->career_id)->first();
            if($user_career):
                 $career_questions   = $user_career->questions()
                                                   ->where('assigned_career','=','0')
                                                   ->where('status','1')
                                                   ->get();
                 //a career can have multiple questions
                 if($career_questions->count() > 0):
                    foreach($career_questions as $career_question):
                        $user_question[$i]['question_id']      = $career_question->id;
                        $user_question [$i]['question_title']  = $career_question->title;
                        $user_question[$i]['question_type']    = $career_question->type;
                        $i++;
                    endforeach;// end of the career_question foreach loop
               endif; // end of the career question count if
            endif; // end of the user_career if
        endif; //end of the user_career_id if

        //now return the user_question array
        return $user_question;
    }


    /**
    * function to store the user tags in the db
    *
    *
    * @param requested tags / skills
    * @return boolen true / false
    *
    *
    **/

    public function insertOrUpdateUserTag($tags){
        //convert the tags into the tags array 
        $tags_array = explode(",", $tags);
        foreach($tags_array as $tag_array){
            //check the tag is in the database or not
            $tag_exists = Tag::where('title',$tag_array)->first();
            if($tag_exists){
                //tag exists in the db now need to update the user tags in the pivot table only
                $tag_exists->users()->attach(Auth::user()->id);
            }else{
                //tage does not exists inerst the tag and update the user tags in the pivot table
                $tag   = new Tag();
                $tag->title    = $tag_array;
                $tag->slug     = str_slug($tag_array);
                $tag->save();

                //now add the in the pivot table 
                $tag->users()->attach(Auth::user()->id);
            }
        }
    }
}
