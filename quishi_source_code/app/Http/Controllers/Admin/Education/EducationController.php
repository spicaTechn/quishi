<?php

namespace App\Http\Controllers\Admin\Education;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Education, Auth;
use Carbon\Carbon;

class EducationController extends Controller
{

    protected $education;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.education.index')
                ->with([
                        'site_title'                =>'Quishi',
                        'page_title'                =>'Education',
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

        $education              = new Education();
        $education->name        = $request->input('title');
        $education->parent      = $request->input('parent_id');
        $education->description = $request->input('description');
        $education->slug        = str_slug($request->input('title'));
        $education->user_id     = Auth::user()->id;
        $education->save();

        return response()->json(array('status'=>'success','result'=>''),200);
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

        $education = Education::findOrFail($id);
        //get the prent education major category only
        $education_major_categories = Education::where('parent',0)->get();
        $return_html = "<option value='0'>None</option>"; 

        if($education_major_categories->count() > 0){
            foreach($education_major_categories as $education_major_category){
                if($education_major_category->id == $education->parent){
                    $return_html .= '<option value="'.$education_major_category->id .'" selected="selected">'.ucwords($education_major_category->name).'</option>';
                }else{
                    $return_html .= '<option value="'.$education_major_category->id .'">'.ucwords($education_major_category->name).'</option>';
                }
            }
        }
        return response()->json(array('status'=>'success','result'=>$education ,'return_option'=> $return_html),200);

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
        $education              = Education::findOrFail($id);
        $education->name        = $request->input('title');
        $education->parent      = $request->input('parent_id');
        $education->description = $request->input('description');
        $education->slug        = str_slug($request->input('title'));
        $education->save();
        return response()->json(array('status'=>'success','result'=>'successfully updated!!'),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // i need to destroy the education major category or education major here 
        $this->education = Education::findOrFail($id);
        $education_type  = "";
        if($this->education->parent > 0){
            $education_type = "Major";
        }else{
            $education_type = "Major Category";
        }
        if($this->education->children()->count() > 0){
             //to delete the education major category need to check have the major or not

            return response()->json(array('status'=>'error','message'=>'Cannot delete major category becuase it contains the major'),200);
        }else{

            //education major check for the user on it
            if($this->education->user_profiles()->count() > 0){
                return response()->json(array('status'=>'error','message'=>'Cannot delete major becuase it used by the career advisior'),200);
            }
        }

        $this->education->delete();

        //delete the education major category or the education major
        return response()->json(array('status'=>'success','message'=>$education_type .' has been deleted successfully!!'),200);


    }




    /**
    * function to get the major category where parent is 0
    *
    * @param void
    * @return \Illumninate\Http\Response
    *
    *
    */
    public function getEducationMajorCategory(){

        $education_major_categories = Education::where('parent',0);
        return Datatables($education_major_categories)
               ->addColumn('action',function($education_major_category){
                        $return_html = '<a href="#" class="m-r-15 text-muted edit-major-category" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-major-id="'.$education_major_category->id.'"><i class="icofont icofont-ui-edit" ></i></a><a href="#" class="text-muted delete-major-category" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-major-id="'.$education_major_category->id.'"><i class="icofont icofont-delete-alt"></i></a>';
                    return $return_html;
                })
                ->addColumn('major',function($education_major_category){
                    return $education_major_category->children()->count();
                })->make('true');
    }



    /**
    * function to get the education major
    * @param void
    * @return \Illuminate\Http\Response
    *
    *
    *
    **/

    public function getEducationMajor(){
        $education_majors = Education::where('parent','>',0)
                            ->where('is_approved','1');
        return Datatables($education_majors)
               ->addColumn('action',function($education_major){
                    $return_html = '<a href="#" class="m-r-15 text-muted edit-major" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-major-id="'.$education_major->id.'"><i class="icofont icofont-ui-edit" ></i></a><a href="#" class="text-muted delete-major" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-major-id="'.$education_major->id.'"><i class="icofont icofont-delete-alt"></i></a>';
                    return $return_html;
                })->addColumn('major_category',function($education_major){
                        return $education_major->parent_education->name;
                                    
                })->addColumn('usage',function($education_major_category){
                    //need to get the total usage by the users
                    return $education_major_category->user_profiles()->count();
                })
                ->make('true');
    }



    /**
    * function to get the major category only
    * @param void
    * @return \Illuminate\Http\Response
    *
    *
    *
    */

    public function getMajorCategory(){

        //get all the education where parent is equal to 0 (parent education major)
        $education_major_cateogries = Education::where('parent',0)->get();
        $return_html                = "<option value='0'>None</option>";

        //loop through each of the major category to render the required html
        foreach($education_major_cateogries as $education_major_category){
            $return_html .= '<option value="'.$education_major_category->id .'">'.ucwords($education_major_category->name).'</option>';
        }

        //return response back to the browser
        return response()->json(array('status'=>'success','result'=>$return_html),200);
    }


    //function to check the education title exists or not


    public function checkEducationTitle(Request $request){

        $education_title = $request->input('title');
        //convert the education title into the slug

        $education_slug = str_slug($education_title);

        $education_details = Education::where('slug',$education_slug)
                                      ->where(function($query) use($request){
                                        if($request->has('id') && !empty($request->get('id'))){
                                            $query->whereNotIn('id',[$request->input('id')]);
                                        }
                                      })
                                      ->first();

        $isAvailable   = true;
        if($education_details){
            //the education title found return true 

            $isAvailable = false;
        }else{
            //the education title not found return false
        }


        //return response
        return response()->json(array('valid'=> $isAvailable));
    }


    /**
     * function to get the user submitted education (major that has not been approved by the admin yet)
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     *
     *
     */

    public function getUserMajors(){
        //get the career advisor submitted education where the education has not been approved by the user
        $unapproved_majors = Education::where('parent','>',0)
                                      ->where('is_approved','0');
        //return response back to the 
         return Datatables($unapproved_majors)
               ->addColumn('action',function($unapproved_major){
                    $return_html = '<a href="#" class="m-r-15 text-muted edit-major" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-major-id="'.$unapproved_major->id.'"><i class="icofont icofont-ui-edit" ></i></a><a href="#" class="m-r-15 text-muted approve-major" data-toggle="tooltip" data-placement="top" title="" data-original-title="Approve" data-major-id="'.$unapproved_major->id.'"><i class="icofont icofont-verification-check"></i></a><a href="#" class="text-muted delete-major" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-major-id="'.$unapproved_major->id.'"><i class="icofont icofont-delete-alt"></i></a>';
                    return $return_html;
                })->addColumn('major_category',function($unapproved_major){
                        return $unapproved_major->parent_education->name;
                                    
                })->filterColumn('created_at', function ($unapproved_major, $keyword) {
                    $unapproved_major->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
                })->addColumn('created_at',function($user){
                    return $user->created_at ? with(new Carbon($user->created_at))->format('Y/m/d') : '';
                })
                ->addColumn('usage',function($unapproved_major){
                    //need to get the total usage by the users
                    return $unapproved_major->user_profiles()->count();
                })->addColumn('submittedBy',function($unapproved_major){
                    return $unapproved_major->submittedBy->name;
                })
                ->make('true');

    }


    /**
     * approve the career advisor submitted majors
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     *
     */
    public function approveMajor(Request $request){
        //get the education by the education id
        $education_details   = Education::findOrFail($request->input('education_id'));
        if($request->has('status') && $request->input('status') == "approved"):
            //udpate the record in the storage
            $education_details->is_approved = "1";
            if($education_details->save()):
                //success message to the client
                return response()->json(array('status'=>'success','msg'=>'Education has been approved!!'),200);
            else:
                return response()->json(array('status'=>'failed','msg'=>'Cannot update recored in the storage, please try again'),200);
            endif;
             
        else:
            //failed reponse back to the client
            return response()->json(array('status'=>'failed','msg'=>'Status not defined'),200);
        endif;
    }
}
