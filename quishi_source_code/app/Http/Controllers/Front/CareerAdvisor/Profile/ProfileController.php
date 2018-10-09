<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\CareerAdvisor\BaseCareerAdvisorController;
use Auth,Validator,DB,Input,File;
use App\Model\UserProfile;
use App\Model\Answer;
use App\Model\Career;
use App\User;
use App\Model\Education;
use App\Model\UserLink;

class ProfileController extends BaseCareerAdvisorController
{
    //
    protected $user_profile_image ="";
    protected $user_profile = "";
    protected $career;
    protected $user_link;

    public function __construct(){

    	return $this->career = Career::where('parent',"=",'0')->where('status','1')->get();
    }

    public function index(Request $reqeust)
    {

        //get the user links
        $this->user_link    = UserLink::where('user_id',Auth::user()->id)->get();
        return view('front.career-advisor.profile.profile')->with(array(
            'site_title'        => 'Quishi',
            'page_title'        => 'Profile',
            'user_links'        => $this->user_link,
        ));
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
        return view('front.career-advisor.profile.profile-setup-1')->with(array(
            'site_title' => 'Quishi',
            'page_title' => 'Profile'
        ));
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
                ])->with(array(
                    'site_title' => 'Quishi',
                    'page_title' => 'Profile'
                ));
            endif;

        }else{
            return view('front.career-advisor.profile.profile-setup-2')->with([
                    'industries'      => $this->career
                ])->with(array(
                    'site_title' => 'Quishi',
                    'page_title' => 'Profile'
                ));
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
                    'education_id'        => $request->input('faculty'),
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
        ])->with(array(
            'site_title' => 'Quishi',
            'page_title' => 'Profile'
        ));
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

       //after the all the questions has been set up insert the dummy user links in the user_link table
        $this->updateUserLinkTable(Auth::user()->id);

       //after that redirect to the profile route after the complete of the profile setup

       return redirect()->route('profile')->with(array(
            'site_title' => 'Quishi',
            'page_title' => 'Profile'
        ));
    }


    /**
    * function to get the education major and major category
    *
    * @param \Illuminate\Http\Request
    *
    * @return \Illuminate\Http\Reponse
    *
    *
    *
    *
    */

    public function getMajor(Request $request){

        $education_majors = Education::where('parent','>',0)
                                        ->where(function($query) use($request){
                                            if($request->has('q')){
                                                $search = $request->input('q');
                                                return $query->where('name','like',"%{$search}%");
                                            }
                                        })
                                        ->select('id','name','parent')
                                        ->get();
        $return_major     = array();
        if($education_majors->count() > 0){
            $i =0;
            foreach($education_majors as $education_major){
                $return_major[$i]['id']     = $education_major->id;
                $return_major[$i]['name']   = $education_major->name;
                $return_major[$i]['parent'] = $education_major->parent_education->name;

                $i++;
            }
        }


        //now return the response 
        return response()->json(array('status'=>'success','result'=>$return_major),200);

        

    }



    ///////////////////////////////////////                   ////////////////////////////////////    ///////////////////////////////////////USER PROFILE LINKS////////////////////////////////////
    //////////////////////////////////////                   //////////////////////////////////

    /**
    * add new user profile for the external link
    *
    * @param \Illuminate\Http\Request
    * @return \Illuminate\Http\Response
    *
    *
    **/

    public function create_user_link(Request $request){

       //get the last link from the db
       $user_external_link_last = UserLink::where('label','like','external_link%')
                                            ->orderBy('created_at','desc')
                                            ->select('label')
                                            ->first();

        if($user_external_link_last):
            //increment the external link by 1 and create new resource
            $external_link_label        = $user_external_link_last->label;
            $external_label             = trim($external_link_label,'external_link');
            $external_label++;
            $new_external_label         = "external_link" . $external_label;

        else:
            //create new resource
            $new_external_label        = "external_link1";
        endif;


        //now save the data
        $user_external_link             = new UserLink();
        $user_external_link->label      = $new_external_label;
        $user_external_link->link       = $request->input('new_link_data');
        $user_external_link->type       = "1";
        $user_external_link->user_id    = Auth::user()->id;
        $user_external_link->save();


        //return response

        $return_html = '<div class="col-md-6">
                            <div class="editable-section">
                                <a href="#" class="hide-social-icon"> <i class="icon-link external_link"></i><span>'.$request->input('new_link_data').'</span></a>
                                <form action=""  style="display: none;" data_link_type="'.$new_external_label.'">
                                    <div class="form-group">
                                        <input type="text" name="facebook-link" class="form-control"  value="'.$request->input('new_link_data').'">
                                    </div>
                                    <div class="button-groups">
                                        <button class="btn btn-success btn-save">Save</button>
                                        <button class="btn btn-secondary btn-cancel">Cancel</button>
                                    </div>
                                </form>
                                <div class="editable-icon">
                                    <a class="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                        <i class="icon-pencil"></i>
                                    </a>
                
                                    <a class="link-delete" data-toggle="tooltip" data-placement="top" title="Delete Link" data-link-id="'.$user_external_link->id.'">
                                        <i class="icon-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>';
        return response()->json(array('status'=>'success','result'=>$return_html),200);
    }


    /**
    * delete user profile link for the external link
    *
    * @param int (link_id)
    * @return \Illuminate\Http\Response
    *
    *
    **/


    public function delete_user_link($id){
        //get the resource by the id
        $user_profile_link = UserLink::findOrFail($id);
        //now delete the user link resource
        $user_profile_link->delete();
        //send the json response
        return response()->json(array('status'=>'success','result'=>'Link has been deleted!!'),200); 
    }




    /**
    * function to update or insert the user links
    *
    * @param \Illuminate\Http\Request
    * @return \Illuminate\Http\Response
    *
    *
    **/

    public function udpate_advisior_links(Request $request){
        $career_link = UserLink::where('label',$request->input('link_type'))->first();
        if($career_link){
            //need to update the link
           //
            $career_link->label         = $request->input('link_type');
            $career_link->link          = $request->input('_social_link_input');
            $career_link->type          = (preg_match( '/^external_link.*/', $request->input('link_type'))) ? '1' : '0';
            $career_link->user_id       = Auth::user()->id;
            $career_link->status        = '1';
            if($career_link->save() > 0){
                return response()->json(array('status'=>'success','result'=>'Successfully updated! '),200);
            }
        }else{
            //need to insert the link
            $career_link = new UserLink();
            $career_link->label         = $request->input('link_type');
            $career_link->link          = $request->input('_social_link_input');
            $career_link->type          = (preg_match( '/^external_link.*/', $request->input('link_type'))) ? '1' : '0';
            $career_link->user_id       = Auth::user()->id;
            if($career_link->save() > 0){
                return response()->json(array('status'=>'success','result'=>'Successfully updated! '),200);
            }
        }
    }
    

}
