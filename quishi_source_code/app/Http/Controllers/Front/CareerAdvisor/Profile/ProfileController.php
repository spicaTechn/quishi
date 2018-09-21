<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\CareerAdvisor\BaseCareerAdvisorController;
use Auth;

class ProfileController extends BaseCareerAdvisorController
{
    //
    protected $user_profile_image ="";
    protected $user_profile = "";

    public function index(Request $reqeust)
    {
        return view('front.career-advisor.profile.profile');
    }

    public function profileLogin()
    {
        return view('front.career-advisor.profile.my-profile-login');
    }
    public function profileAccount()
    {
        return view('front.career-advisor.profile.profile-account');
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
        return view('front.career-advisor.profile.profile-setup-1');
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
            'age_group'     => 'required',
            'user_image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ])->validate();

            //validation passed !!
            //upload the user image if have 
            $user = Auth::user();
            if($request->hasFile('user_image')){
                //need to upload the image in the directory and store the path in the db
                $user_image                 = $request->file('user_image');
                $name                       = time() . '.'.$user_image->getClientOriginalExtension();
                $destination_path           = "front/images/profile";
                $user_image->move($destination_path,$name);
                $this->user_profile_image   = $name;

                //$user_profile->image_path = 'image_name';
            }
            
                //need to insert the data in the db
                $this->user_profile               = new UserProfile();
                $this->user_profile->first_name  = $request->input('name');
                $this->user_profile->last_name   = '';
                $this->user_profile->location    = $request->input('address');
                $this->user_profile->age_group   = $request->input('age_group');
                $this->user_profile->image_path  = $this->user_profile_image;
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
                return view('front.career-advisor.profile.profile-setup-2')->with([
                    'industries'      => $this->career
                ]);
            endif;

        }else{
            return view('front.career-advisor.profile.profile-setup-2')->with([
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
            return redirect()->route('profile.setup.step3');
        }
        return view('front.career-advisor.profile.profile-setup-3')->with([
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
}
