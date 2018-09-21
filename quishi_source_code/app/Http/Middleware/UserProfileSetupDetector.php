<?php

namespace App\Http\Middleware;

use Closure;

class UserProfileSetupDetector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //now check for the user has setup profile or not 
        if($request->user() && $request->user()->logged_in_type == 0){
            //logged in user and user is career advisior
            if($request->user()->user_profile()->count() > 0):
                if($request->user()->user_profile->profile_setup_status == 3):
                    //user has completed its profile setup thus redirect the user to the profile page
                     return $next($request);
                else:
                    //now check where the user is in profile setup 
                    $career_advisior_profile_setup = $request->user()->user_profile->profile_setup_steps;
                    switch($career_advisior_profile_setup){
                        case 0:
                             //user has not setup the profile yet
                             return redirect()->route('profile.setup.step1');
                             break;
                        case 1:
                            // user has completed the step 1 
                            return redirect()->route('profile.setup.step2');
                            break;

                        case 2: 
                            //user has completed the profile setup step 1 and 2 now redirect the user to the third step
                            return redirect()->route('profile.setup.step3');
                            break;
                        default:
                            break;
                    }
                endif;
                
            else:
             
            return redirect()->route('profile.setup.step1');
            endif;
        }
        return $next($request);
    }
}
