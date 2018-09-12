<?php

namespace App\Http\Controllers\Admin\Industry;

use Illuminate\Http\Request;
use App\Model\Career;
use App\Http\Controllers\Controller;

class IndustryController extends Controller
{

    protected $career;
    public function __construct(Career $career){
        $this->career = $career;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.industry-and-job.index')
                ->with([
                        'site_title'                =>'Quishi',
                        'page_title'                =>'Industry and jobs',
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
       $industryJobs                = new Career();
       $industryJobs->title         = $request->input('title');
       $industryJobs->slug          = str_slug($request->input('title'));
       $industryJobs->description   = $request->input('description');
       $industryJobs->parent        = $request->input('parent_id');
       $industryJobs->save();
       return response()->json(array('status'=>'success','result'=>'successfully added the industry / job in the quishi system'),200);
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

        $career_details = Career::findOrFail($id);
        //get the parent category 
        $parent_job_category = $this->career->getParentCareer();
        $return_html         = "<option value='0'>None</option>";
        if($parent_job_category->count() > 0){
            foreach($parent_job_category as $parent_job){
                if($parent_job->id == $career_details->parent){
                    $return_html .= '<option value="'.$parent_job->id .'" selected="selected">'.ucwords($parent_job->title).'</option>';
                }else{
                    $return_html .= '<option value="'.$parent_job->id .'">'.ucwords($parent_job->title).'</option>';
                }
            }
           
        }

        return response()->json(array('result'=> $career_details,'return_option'=>$return_html),200);
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
       $career = Career::findOrFail($id);
       $career->title         = $request->input('title');
       $career->slug          = str_slug($request->input('title'));
       $career->description   = $request->input('description');
       $career->parent        = $request->input('parent_id');
       $career->save();
       return response()->json(array('status'=>'success','result'=>'successfully added udpadted industry / job in the quishi system'),200);
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
    * function to return the parent career
    * @param void
    *
    * @return json_object
    */

    public function getCareerIndustry(){

        //get the career having the parent 0
        $parent_job_category = $this->career->getParentCareer();
        $return_html         = "<option value='0'>None</option>";
        if($parent_job_category->count() > 0){
            foreach($parent_job_category as $parent_job){
                 $return_html .= '<option value="'.$parent_job->id .'">'.ucwords($parent_job->title).'</option>';
            }
           
        }

        return response()->json(array('result'=>$return_html),200);
    }


    //fuctiion to return the datables request for the jobs and industry


    public function getJobs(){
        $jobs = Career::select('id','title','description')->where('parent' ,'>',0);
        return Datatables($jobs)
                                ->addColumn('action',function($job){
                                    $return_html = '<a href="#" class="m-r-15 text-muted edit-job" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" 
                                                      title="" 
                                                      data-original-title="Edit"
                                                      data-industry-id="'.$job->id.'">
                                                   <i class="icofont icofont-ui-edit" ></i>
                                                   </a>
                                                   <a href="#" class="text-muted delete-job" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" title="" 
                                                      data-original-title="Delete" 
                                                      data-industry-id="'.$job->id.'">
                                                   <i class="icofont icofont-delete-alt"></i>
                                                   </a>';
                                return $return_html;
                                })
                                ->addColumn('usage',function($job){
                                    return '5';
                                })
                                ->make(true);


    }




    public function getIndustry(){
        $industries = Career::where('parent',0)->select('id','title','description');

        //return the response as the datatable
        return Datatables($industries)
               ->addColumn('action',function($industry){
                    $return_html = '<a href="#" class="m-r-15 text-muted edit-industry" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"data-industry-id="'.$industry->id.'"><i class="icofont icofont-ui-edit" ></i></a><a href="#" class="text-muted delete-industry" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-industry-id="'.$industry->id.'"><i class="icofont icofont-delete-alt"></i></a>';
                    return $return_html;
               })
               ->addColumn('usage',function($industry){
                    return $industry->children()->count();
               })
               ->make(true);
    }
}
