<?php

namespace App\Http\Controllers\Front\Pages\Forum;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Input,Validator,Auth,Carbon\Carbon;
use App\Model\ForumQuestion;
use App\Model\ForumQuestionAnswer;
use App\Model\UserProfile;
use App\User;
use DB;


class ForumPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all question form databasee
        $questions = ForumQuestion::orderBy('created_at','desc')->paginate(10);

        //echo "<pre>"; print_r($questions); echo "</pre>"; exit;
        return view('front.pages.forum.forum')->with(array(
            'site_title'   =>  'Quishi',
            'page_title'   =>  'Forum',
            'questions'    =>   $questions,

        ));
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
        $checked_value= $request->input('add-anomynouse-question');
        $question     = $request->input('question');
        $user_id      = Auth::id();

        //save the data into db
        $forum            = new ForumQuestion();
        $forum->user_id   = Auth::user()->id;
        $forum->posted_on = Carbon::now();
        $forum->type      = ($request->has('add-anomynouse-question')) ? '1' : '0';
        $forum->title     = $question;
        $forum->slug      = str_slug($question);
        $forum->save();

        return response()->json(array('status'=>'success','result'=>'successfully added question to  the quishi system'),200);
        //echo "<pre>"; print_r($question); echo "</pre>"; exit;
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
        $question  = ForumQuestion::find($id);

        return view('front.pages.single-pages.single-forum')->with(array(
            'site_title'   =>  'Quishi',
            'page_title'   =>  'Forum',
            'question'     =>  $question
        ));
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





}
