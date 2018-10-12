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
        $parent_job_category = Career::where('parent','=','0')->get();
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
        $career_industry        =  Career::findOrFail($id);
        $parent_id              = $career_industry->parent;
        //check if has child or not
        $career_job             = Career::where('parent',$career_industry->id)->get();
       
        if($career_job->count() > 0 )
        {
            //the industry has parent don't allow to delete the parent industry
            return response()->json(array('status'=>'error','message'=>'The industry cannot be deleted because it contains the job in it'),200);
        }else{
             //to do check the job has the user or not before deleting it
            if($career_industry->parent == 0)
                $message = "Industry";
            else
                $message = "Job";
            $career_industry->delete();
            return response()->json(array('status'=>'success','message'=> $message .' has been deleted successfully!' ),200);
        }
        //delete the parent 

    }




    /**
    * function to return the parent career
    * @param void
    *
    * @return json_object
    */

    public function getCareerIndustry(){

        //get the career having the parent 0
        $parent_job_category = Career::where('parent','=','0')->get();
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
        $jobs = Career::where('parent' ,'>',0);
        return Datatables($jobs)
                                ->addColumn('parent_industry',function($job){
                                    return ucwords($job->parent_career->title);
                                })
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


    /**
    * gets parent industry and jobs like Graphics Designer - IT and telecommunication
    *
    * @param void
    * @return json object
    *
    */


    public function getIndustryJobs(Request $request){
        //return jobs array
        $return_jobs = array();
        $career_details = Career::where('status','1')
                                ->where('parent','>',0)
                                ->where(function($query) use($request){
                                    if($request->has('q')){
                                        //only use the like if request has q
                                        $search=$request->input('q');
                                        return $query->where('title','like',"%{$search}%");
                                    }
                                })->select('id','title','parent')
                                ->get();
        
        if($request->has('q')){
            $i = 0;
        }else{
            $return_jobs[0]['id']   = 'all';
            $return_jobs[0]['title'] = 'All';
            $return_jobs[0]['parent_title'] ='All'; 
            $i  = 1;
        }
        
        if($career_details->count() > 0){
            //there are career listed 
            foreach($career_details as $career){
                $return_jobs[$i]['id']              = $career->id;
                $return_jobs[$i]['title']           = ucwords($career->title);

                //get the parent title by the parent id
                $career_parent = career::where('id',$career->parent)
                                        ->select('title')
                                        ->first();
                //add the parent title in the return jobs array
                if($career_parent)
                    $return_jobs[$i]['parent_title']    = ucwords($career_parent->title);

                $i++;
            }

        }

       return response()->json(array('status'=>'success','result'=>$return_jobs),200);
    }




    //function to check the dublication title for the industry and job title


    public function checkIndustryTitle(Request $request){

        //get the career requested title
        $career_title     = $request->input('title');
        //convert the tilte into the slug cause slug is unique 
        $career_slug     = str_slug($career_title);

        //get the career details by the career slug
        $career_details = Career::where('slug',$career_slug)->first();
        //initialize the variable here with boolean true value
        $isAvailable    = true;

        if($career_details){
            //found return false
            $isAvailable  = false;
        }else{
            //not found return true
        }

        //now send the response back to the requestor
        return response()->json(array('valid'=> $isAvailable),200);
    }
}
