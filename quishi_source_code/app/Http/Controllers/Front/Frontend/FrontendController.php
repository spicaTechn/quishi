<?php

namespace App\Http\Controllers\Front\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\UserActivation;
use App\Model\UserProfile;

class FrontendController extends Controller
{
 
    //
    public function activateUser(Request $request,$user_email,$activation_token){
    	//check for users email
    	$registered_user_details                 = User::where('email',$user_email)->first();

    	//if users exists
    	if($registered_user_details):
    		//check for the email token
    		$registered_user_email_token_details = UserActivation::where('user_id',$registered_user_details->id)
    															 ->where('email_token',$activation_token)
    															 ->get();
    		//token exists
    	    if($registered_user_email_token_details->count() > 0):
    	    	//check user profile 
    	    	if($registered_user_details->user_profile()->count() > 0):
    	    	// if setup completed update the status only
    	    		if($registered_user_details->user_profile->profile_setup_status == "1"):
	    	    		$user_profile                     = UserProfile::where('user_id',$registered_user_details->id);
		    	    	$user_profile->status             = "1";
		    	    	$user_profile->save();
		    	    endif;
    	    	endif;

    	    	$this->removeEmailToken($registered_user_details);
    	        //return redirect to login
    	    	return redirect('/login')->with('status', 'Email  has been verified, please complete your profile if not completed yet to be publicly visible!!');
    	    else:
    	    	//token not exists
    	    	//check the user account status 
    	    	if($registered_user_details->user_profile()->count() > 0):
	    	    	if($registered_user_details->user_profile->status == "1"):
	    	    		//account already activation thus validation links expired
	    	    		return redirect('/login')->with('status', 'Email has been already verified, please update your profile if not updated yet to be publicly visible!!');
	    	    	endif;
	    	    else:
		    		//token not matched
		    		dd('The verification link has been expired!!');
		    		exit;
	    	    endif; //profile exists or not
    	    endif;
    	else:
    		//user does not exists
    		dd('The career advisor does not exists in our system, please register with this email if you own this email');
    		exit;
    	endif;
    }



    /**
     * Function to remove the email token from user_activations
     *
     *
     * @param obj($user_details)
     * @return bol
     *
     */

    protected function removeEmailToken($user_details){
    	$user_token_details = UserActivation::where('user_id',$user_details->id)->first();
    	$user_token_details->email_token = "";
    	if($user_token_details->save()){
    		return true;
    	}else{
    		return false;
    	}
    }
}
