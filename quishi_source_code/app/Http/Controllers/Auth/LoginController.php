<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite, Hash,Auth,File;
use App\User;
use App\Model\UserProfile;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //now insert the current ip address of the user in order to track the user details
        $user->last_logged_in_ip = request()->ip();
        $user->save();
        

        //now check for the user profile if the user is the career advisior not for the super admin

    }

    /**
     * Redirect the user to the provider(facebook and google) authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider(facebook, google).
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        //check for the user is exists or not using the email 
        if($user && $user->email != ""):
            $career_adviser_details = User::where('email',$user->email)->first();
            if($career_adviser_details):
                //the user is already register with this email then change only the sign_in_type
                $career_adviser_details->sign_in_type = '1';
                $career_adviser_details->save();
                Auth::login($career_adviser_details);
            else:
                //create new user
                $new_career_advisior = User::create([
                    'password'       => Hash::make(str_random(20)),
                    'email'          => $user->email,
                    'provider'       => $provider,
                    'provider_id'    => $user->id,
                    'sign_in_type'   => '1',
                    'name'           => $user->name
                ]);

                //need to upload the image if provided
                $this->saveUserImageIfExists($user,$new_career_advisior);
                Auth::login($new_career_advisior,true);
            endif;

            return redirect($this->redirectTo);
        elseif($user && $user->email == ""):
            //user does not have email 
            //check the user by the profile id 
            $career_adviser_details = User::where('provider_id',$user->id)->first();
            if($career_adviser_details):
                //no need to do anything just logged the user
            else:
                //create the new user with the email sociallogin@gmail.com as the default email address
                $new_career_advisior = User::create([
                    'password'       => Hash::make(str_random(20)),
                    'email'          => 'sociallogin@gmail.com',
                    'provider'       => $provider,
                    'provider_id'    => $user->id,
                    'sign_in_type'   => '1',
                    'name'           => $user->name
                ]);
                $this->saveUserImageIfExists($user,$new_career_advisior);
                Auth::login($new_career_advisior,true);
            endif;
            return redirect($this->redirectTo);
        else:
            return redirect('/login');
        endif;
    }


    /**
     * function to save the user avatar if exists
     *
     * @param $user, $new_career_advisor
     * @return void
     */

    protected function saveUserImageIfExists($user,$new_career_advisior){
        $filepath =$_SERVER['DOCUMENT_ROOT']. "/front/images/profile/".$user->id.'.jpg';
        $new_career_advisor_image = $user->avatar_original;
        if($new_career_advisor_image){
            //save the image and update user profile table
            $new_profile_image = file_get_contents($user->avatar_original);
            if(file_put_contents($filepath,$new_profile_image)){
                $career_adviser_profile               = new UserProfile();
                $career_adviser_profile->first_name   = $user->name;
                $career_adviser_profile->last_name    = '';
                $career_adviser_profile->user_id      = $new_career_advisior->id;
                $career_adviser_profile->image_path   = $user->id.'.jpg';
                $career_adviser_profile->save();
            }
        }
    }
}
