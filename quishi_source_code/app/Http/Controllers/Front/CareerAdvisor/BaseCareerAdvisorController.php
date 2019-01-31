<?php

namespace App\Http\Controllers\Front\CareerAdvisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Career;
use App\Model\Question;
use App\User;
use DB,Auth;
use App\Model\Tag;
use App\Model\UserLink;

class BaseCareerAdvisorController extends Controller
{
    //
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
            $tag_exists = Tag::where('slug',str_slug($tag_array))->first();
            if($tag_exists){
                //tag exists in the db now need to update the user tags in the pivot table only
                //delete the recored first
                DB::table('user_tag')->where('user_id',Auth::user()->id)->delete();
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


     /**
    *
    * function to get the job by parent parent industry
    *
    * @param Illuminate\Http\Request
    * @return json object
    *
    */

    public function getJobByIndustryId(Request $request){
        
        //get the admin added job title by the industry id
        $admin_users        = User::where('logged_in_type','1')->select('id')->get();
        $admin_ids          = array();
        //loop throgh each admin users
        foreach($admin_users as $admin_user):
            array_push($admin_ids, $admin_user->id);
        endforeach;

        //check the career advisor is logged in or not
        if(Auth::check()):
            //if logged in add user id in the admin id
            array_push($admin_ids,Auth::user()->id);
        endif;

        //get the job title by the parent industry that were added by the admins
        $job_by_industry_id = Career::where('parent',$request->input('industry_id'))
                                    ->whereIn('user_id',$admin_ids)
                                    ->select('id','title')->get();
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
    * update the user links table when the user complete the profile setup
    *
    * @param int user_id
    * @return boolean true / false
    *
    *
    **/

    protected function updateUserLinkTable($user_id){

        $data           = array(
                                array(
                                    'user_id'       =>$user_id,
                                    'label'         =>'facebook_link',
                                    'link'          => 'https://www.facebook.com/',
                                    'type'          => '0', //0 for the social links and 1 for the external links
                                    'created_at'    => now(),
                                    'updated_at'    => now()
                                ),
                                array(
                                    'user_id'       => $user_id,
                                    'lable'         =>'twitter_link',
                                    'link'          => 'https:://www.twiiter.com/',
                                    'type'          => '0', // 0 for the social links and 1 for the external links
                                    'created_at'    => now(),
                                    'updated_at'    => now(),
                                ),
                                array(
                                    'user_id'       => $user_id,
                                    'label'         => 'google_plus_link',
                                    'link'          => 'https://plus.google.com/discover',
                                    'type'          => '0', // 0 for the social links and 1 for the external links
                                    'created_at'    => now(),
                                    'updated_at'    => now()
                                ),
                                array(
                                    'user_id'       => $user_id,
                                    'label'         => 'linkedin_link',
                                    'link'          => 'https://www.linkedin.com/',
                                    'type'          => '0',
                                    'created_at'    => now(),
                                    'updated_at'    => now()
                                )
                            );

        //now insert the data into the table
        if(UserLink::insert($data) > 0)
        {
            return true;
        }


        return false;

    }


}
