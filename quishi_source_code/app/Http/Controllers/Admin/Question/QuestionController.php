<?php

namespace App\Http\Controllers\Admin\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Question;
use App\Model\Career;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $question;
    public function index()
    {
        //
        return view('admin.question.index')
                ->with([
                        'site_title'                =>'Quishi',
                        'page_title'                =>'Question',
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
        // question-type 1 for the manditory and 0 for the optional 

        // all for the  1 assigned all career and 0 for the specific career
        $question               = $request->input('question');
        $selected_job           = $request->input('parent-job');
        $question_type          = $request->input('question-type');
        $question_assigned_type = 0;
        $career_id = array();

        for($i=0;$i<count($selected_job); $i++){
            //stored all the career 
            if($selected_job[$i] == 'all'){
                //get all the career stored in the db with the status active
                $careers        = Career::where('status','1')
                                ->where('parent','>',0)
                                ->select('id')
                                ->get();
                if($careers->count() > 0){
                    foreach($careers as $career){
                        $career_id[]  = $career->id;
                    }
                }
                $question_assigned_type = 1;
            }else{
                $career_id[] =  $selected_job[$i];
            }
        }

       $this->question           = new Question();
       $this->question->title    = $question;
       $this->question->type     = $question_type;
       $this->assigned_career    = $question_assigned_type;
       $this->question->save();

       //now save data in the pivot table 
       $this->question->careers()->attach($career_id);

       if($this->question->id > 0){
        return response()->json(array('status'=>'success','result'=>'Question has been added successfully!!'),200);
       }else{
        return response()->json(array('status'=> 'error','result'=> 'Question can not be added please try again later on!!'),200);
       }


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

        $this->question = Question::findOrFail($id);
        $careers = $this->question->careers->where('parent','>',0);
        return response()->json(array('status'=>'success','result'=>$this->question,'career'=>$careers),200);
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
    * function to get the data from the questions db
    *
    *
    *
    **/

    public function getQuestions(){
        $questions = Question::with('careers')->select('questions.*')->get();
        return Datatables($questions)
               ->addColumn('job_title',function(){
                    return 'Cooking';
               })
               ->addColumn('total_answer',function(){
                return 0;
               })
               ->addColumn('type',function($question){
                    if($question->type == 1){
                        return 'Mandatory';
                    }else{
                        return 'Optional';
                    }
               })
               ->addColumn('job_title',function($question){
                    return $question->careers->map(function($job_title){
                            return ucwords($job_title->title);
                        })->implode(',');
               })
               ->addColumn('status',function($question){
                    if($question->status == 1){
                        return 'Active';
                    }else{
                        return 'Inactive';
                    }
               })
               ->addColumn('action',function($question){
                $return_html = "";
                $return_html .= '<a href="#" class="m-r-15 text-muted edit-question" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-question-id="'.$question->id.'"><i class="icofont icofont-ui-edit"></i></a><a href="#" class="text-muted delete-question" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-question-id="'.$question->id.'"><i class="icofont icofont-delete-alt"></i></a>';
                return $return_html;
               })
               ->make(true);
    }
}
