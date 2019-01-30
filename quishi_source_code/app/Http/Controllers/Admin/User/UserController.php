<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User, URL;
use App\Model\Review;
use App\Model\UserProfile;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $career_advisior = User::where('logged_in_type',1)->get();
        return view('admin.user.index')
                ->with([
                        'site_title'                =>'Quishi',
                        'page_title'                =>'User',
                        'career_advisiors'          => $career_advisior
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
    public function update(Request $request)
    {
        //
        $user_profile         = UserProfile::where('user_id',$request->input('career_advisior_id'))->firstOrFail();
        $career_advisior_id   = $request->input('career_advisior_id');
        $status               = $request->input('status');
        $user_profile->status = $status;
        if($user_profile->save() > 0){
          return response()->json(array('status'=>'success','result'=>'Career Advisior has been updated successfully !'),200);
        }

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
    * function to get the career advisior
    *
    * @param void
    * @return Illuminate\Http\Response
    *
    *
    *
    */


    public function getCareerAdvisor(){
        $career_advisiors   = User::with(['user_profile','careers'])
                                  ->whereHas('user_profile',function($q){
                                    $q->where('profile_setup_status','>=','1');
                                  })
                                  ->where('logged_in_type',1);
        return Datatables($career_advisiors)
               
               ->addColumn('job_title',function(User $user){
                   
                    return $user->careers->map(function($job_title){
                                return ucwords($job_title->title);
                    })->implode(','); 
               })
               ->addColumn('user_image',function($career_advisior){
                    if($career_advisior->user_profile->image_path != "")
                        return asset('/front/images/profile/'.$career_advisior->user_profile->image_path);
                    else
                        return asset('/admin_assets/assets/images/widget/user2.png');
               })
               
               ->addColumn('profile_views_count',function($career_advisior){
                    return $career_advisior->user_profile->profile_views;
                    //return '0';
               })->addColumn('action',function($career_advisior){
                    $return_html = " ";
                    $user_url    = URL::to('/career-advisor/'.$career_advisior->id .'/'. $career_advisior->user_profile->first_name);
                    $return_html .= '<a href="'.$user_url.'" 
                                          class="m-r-15 text-muted view-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="View More" 
                                          data-user-id="'.$career_advisior->id.'" target="_blank">
                                          <i class="icofont icofont-business-man-alt-3"></i>
                                        </a>

                                        <a href="#" 
                                          class="m-r-15 text-muted review-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="Write Review" 
                                          data-user-id="'.$career_advisior->id.'">
                                          <i class="icofont icofont-comment"></i>
                                        </a>';
                    if($career_advisior->user_profile->status == '0'):
                      $return_html .= '<a href="#" 
                                          class="text-muted activate-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="Activate" 
                                          data-user-id="'.$career_advisior->id.'" data-status="activate">
                                          <i class="icofont icofont-ui-check"></i>
                                        </a>';
                    else:
                        $return_html .= '<a href="#" 
                                          class="m-r-15 text-muted deactivate-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="Deactivate" 
                                          data-user-id="'.$career_advisior->id.'" data-status="deactivate">
                                          <i class="icofont icofont-ui-lock"></i>
                                        </a>';

                    endif;
                return $return_html;
               })
               ->make(true);

    }



    /**
    * show the user reviews provided by the admin
    * @param \Illuninate\Http\Rquest
    *
    * @return Illuminate\Http\Respone
    *
    *
    */

    public function showAdminReviews(Request $request){
      $career_seeker_id = $request->input('user_id');
      $career_seeker = User::findOrFail($career_seeker_id);
      //user reviews
      $career_seeker_reivews = $career_seeker->reviews()->where('status','0')->orderBy('created_at','desc')->get();

      $return_html =  view('admin.inc.user_reviews')->with([
                                          'career_seeker'                 => $career_seeker,
                                          'career_seeker_admin_reviews'   => $career_seeker_reivews
                                        ])->render();
      return response()->json(array('status'=>'success','result'=>$return_html),200);
    }



    /**
    * function to add new review resource in the storage
    *
    *  @param Illunminate\Http\Rquest
    *
    * @return \Illuminate\Http\Response
    *
    */


    public function createReview(Request $request){

      $review            = new Review();
      $review->content   = $request->input('review_content');
      $review->user_id   = $request->input('career_advisior_id');
      $review->status    = '0';
      //store the new reviews
      $review->save();

      //get the user reviews data
      $career_seeker     = User::findOrFail($request->input('career_advisior_id'));
      $reviews           = Review::where('user_id',$career_seeker->id)->where('status','0')->orderBy('created_at','desc')->get();

      //render the html
      $result            = $this->renderCareerAdvisiorUnsolvedReview($reviews,$career_seeker);
      return response()->json(array('status'=>'success','result'=>$result),200);
    }



    /**
    * function to add new reviews given by the superadmin
    *
    * @param \Illuminate\Http\Request
    * @return \Illuminate\Http\Response
    *
    *
    */

    public function updateCareerReviewStatus(Request $request){
      $review     = Review::findOrFail($request->input('reivew_id'));
      $review->status = '1';
      $review->save();

      //get the reveiws by the user_id where status 0
      $career_seeker_id = $request->input('career_seeker_id');
      $career_seeker = User::findOrFail($career_seeker_id);
      //user reviews
      $career_seeker_reivews = Review::where('user_id',$career_seeker_id)->where('status','0')->orderBy('id','desc')->get();
      $result = $this->renderCareerAdvisiorUnsolvedReview($career_seeker_reivews,$career_seeker);
      return response()->json(array('status'=>'success','result'=>$result),200);
    }




    /**
    * function to render the career advisior unresolved reivew after the new creation or update
    *
    * @param object $reviews
    *
    * @return string $result
    *
    *
    */

    protected function renderCareerAdvisiorUnsolvedReview($reviews,$career_seeker){
      $result = '<ul class="basic-list list-icons">';
      foreach($reviews as $admin_review){
        $result .= '<li>
                      <p>'.$admin_review->content.'</p>
                      <button type="button" class="btn btn-primary btn-mini waves-effect waves-light  p-absolute text-center d-block resolve-review" data-review-id="'.$admin_review->id.'" data-career-seeker-id="'.$career_seeker->id.'">Resolve review
                      </button>
                    </li>';
      }
      $result .= "</ul>";

      return $result;
    }
}
