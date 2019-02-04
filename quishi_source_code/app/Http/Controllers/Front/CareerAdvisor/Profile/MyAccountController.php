<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\CareerAdvisor\BaseCareerAdvisorController;
use App\Http\Controllers\Controller;
use App\Model\Career;
use App\Model\Education, App\Model\Tag;
use App\User, App\Model\UserProfile;
use App\Model\Answer;
use Auth,DB,File,Input,Session,Hash,URL,Mail;
use App\Mail\emailConfirmation;
use App\Model\UserActivation;

class MyAccountController extends BaseCareerAdvisorController
{
    //

    protected $career;
    protected $major;
    protected $user_tags = array();
    protected $user_profile_image_path = "front/images/profile";
    protected $user_profile_image  = "";

    public function __construct(){
    	$this->career = Career::where('parent',"=",'0')->where('status','1')->get();
    }

    /**
    * to show the particular account resource
    *
    * @param void
    * @return \Illuminate\Http\Response
    *
    *
    **/

    public function index(){

    	//render the education major and the education major category
    	$education_major   		=  Education::where('parent','>',0)->get();

    	$user_selected_careers 	= Auth::user()->careers()->select('careers.id','careers.title')->first();
    	$user_selected_industry = Career::where('id', $user_selected_careers->id)->get();

    	//user selected industry
    	foreach($user_selected_industry as $selected_industry):
	    	$user_industry_id = $selected_industry->parent_career->id;

    	endforeach;


    	//render the curent user questions
    	$user_questions    		= $this->getCurrentUserCareer(Auth::user()->id);
    	$i = 0;
    	//add user anwer on the render current user questions
    	foreach($user_questions as $user_question){
    		 $questions_id = $user_question['question_id'];
	         $answers = DB::table('answers')->where('question_id',$questions_id)->where('user_id', Auth::user()->id)->select('content')->first();
             if($answers):
	           $user_questions[$i]['answer'] = $answers->content;
             else:
                 $user_questions[$i]['answer'] = '';
             endif;
	         $i++;

    	}

    	//loop through the each user tags
    	foreach(Auth::user()->tags as $tag){
    		$this->user_tags[] = $tag->title;
    	}

    	//return view with the requried parameters
    	return view('front.career-advisor.my-account.index')->with([
    				'industries'					=> $this->career,
    				'majors'						=> $education_major,
    				'user_tags'						=> $this->user_tags,
    				'user_questions_and_answers'	=> $user_questions,
    				'user_careers'					=> $user_selected_careers,
    				'user_industry_id'				=> $user_industry_id,
    				'user_selected_industry_details'=> $user_selected_industry,
    	]);

    }

    /**
    * to show the form to create the new resources
    * @param int ($id)
    *
    *
    *
    *
    *
    **/
    public function create(){

    }



    /**
    * update the resource
    * @param \Illuminate\Http\Request 
    * @param int id
    * @return \Illuminate\Http\Response
    *
    *
    *
    **/

    public function update(Request $request,$id){
    	//udpate the user profile
    	$user   				  		= User::findOrFail(Auth::user()->id);
    	//check the user_image was set or not
    	if($request->hasFile('user_image')){
    		//user image was set then need to upload the image 
    		$user_profile_pic    		= $request->file('user_image');
    		$name                		= time() . '.'.$user_profile_pic->getClientOriginalExtension();
    		$user_profile_pic->move($this->user_profile_image_path,$name);
    		$this->user_profile_image   = $name;
    		//delete the old image if any
    	
	        $file = $_SERVER['DOCUMENT_ROOT'].'/quishi/front/images/profile/'.$user->user_profile->image_path;
	        if(file_exists($file)):
	        	 \File::delete($file);
	        endif;
	      
    	}else{
    		$this->user_profile_image  = $user->user_profile->image_path;
    	}

    	//initalize the user profile 
    	$user_profile 			  		 = $user->user_profile ? : new UserProfile();
    	$user_profile->first_name 		 = $request->input('fullname');
    	$user_profile->age_group    	 = $request->input('age_group');
    	$user_profile->location     	 = $request->input('address');
    	$user_profile->description  	 = $request->input('description');
    	$user_profile->image_path   	 = $this->user_profile_image;
    	$user_profile->educational_level = $request->input('education');
    	$user_profile->job_experience    = $request->input('job_experience');
    	$user_profile->education_id      = $request->input('faculty');
    	$user_profile->salary_range      = $request->input('salary');
    	$user_profile->skills             = $request->input('skills');
    	$user_profile->save();
    	//remove the , from the skills

    	$user_skills_array               = explode(',', $request->input('skills'));

    	$tag_ids 						= array();
    	foreach($user_skills_array as $user_skill){
    		$tag        = Tag::where('slug',str_slug($user_skill))->first();
    		if($tag):
    			$tag_ids[]   = $tag->id;
    		else:
                //need to insert the tags and return the tag id
                $new_tag    = new Tag();
                $new_tag->title = $user_skill;
                $new_tag->slug  = str_slug($user_skill);
                $new_tag->save();
                $tag_ids[]  = $new_tag->id;
            endif;
    	}


    	//udate the data in the user tags pivot table
    	$user->tags()->sync($tag_ids);

    	//update user job title but not applicable here 
    	//$user->careers()->sync(array($request->input('job_title')));

    	//update user answer
    	$submitted_user_answer = $request->input('answer_id');
    	$submitted_question    = $request->input('question_id');
    	for($i=0; $i<count($submitted_question); $i++){
            //to check for the answer exists or not 
            $user_answer      = Answer::where('question_id',$submitted_question[$i])
                                        ->where('user_id',Auth::user()->id)->get();

            if($user_answer->count() >= 1):
    		  $user_answer      = Answer::where('question_id',$submitted_question[$i])
    									->where('user_id',Auth::user()->id)
    									->update(['content'=> $submitted_user_answer[$i]]);
            else:
                $user_answer              = new Answer();
                $user_answer->question_id = $submitted_question[$i];
                $user_answer->user_id     = Auth::user()->id;
                $user_answer->content     = $submitted_user_answer[$i];
                $user_answer->total_likes = 0;
                $user_answer->save();
            endif;
    	}

    	Session::flash('user_profile_update', 'Your profile has been updated successfully!!');

    	return redirect()->route('careerAdvisior.my-account.index');


    }


    //CHANGE PASSOWRD

    //show the form to change the password

    public function change_logged_in_user_password(){
        if(Auth::user()->sign_in_type == '0'):
            return view('front.career-advisor.my-account.change-password');
        else:
            return redirect()->route('profile');
        endif;
    }


    public function change_password(Request $request){
        $old_input_password = $request->input('old_password');
        if(Hash::check($old_input_password,Auth::user()->password)){
            //the input old password matches with the store passowrd
            //proceed forward
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($request->input('password'));
            $user->save();
            //logout from all devices and redirect to the login page with the session message
            Auth::logout();
            //send email regarding the passowrd change
            
            return redirect()->route('login');
        }else{
            return redirect()->back()->withErrors(['old_password'=> 'Old password is invalid!!']);
        }
    }


    
    /**
     * function to resend the email verfication to the career advisor
     *
     * @param Illuminate\Htpp\Request
     *
     * @return Illuminate\Http\Response
     *
     *
     */

    public function resendVerificationLink(Request $request){
       //get the current logged in user
       $current_logged_in_career_advisor_id  = Auth::user()->id;
       $email_token                          = str_random(40);
       $user_activation                      = new UserActivation();
       $user_activation->user_id             = $current_logged_in_career_advisor_id;
       $user_activation->email_token         = $email_token;
       $user_activation->save(); 
       $callback_url                         = URL::to('/verify/'.Auth::user()->email.'/'.$email_token);
       Mail::to(Auth::user()->email)->send(new emailConfirmation(Auth::user(),$email_token,$callback_url));

       //return back the response
       return response()->json(array('status'=>'success'),200);

    }
}
