<?php

namespace App\Http\Controllers\Admin\Education;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Education;

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
        $education = Education::findOrFail($id);
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
        $education_majors = Education::where('parent','>',0);
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
}
