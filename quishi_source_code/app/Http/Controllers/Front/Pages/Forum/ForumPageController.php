<?php

namespace App\Http\Controllers\Front\Pages\Forum;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Input,Validator,Auth;
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
        $questions = ForumQuestion::paginate(3);

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
        $email        = $request->input('ask-anonymous');
        $question     = $request->input('question');
        $user_id      = Auth::id();
        $forum        = new ForumQuestion();
        //echo "<pre>"; print_r($user_id); echo "</pre>"; exit;
        if(empty($user_id) && ($checked_value=='on')){
            $user_email = User::where('email', '=', $email)->first();
            //echo "<pre>"; print_r($user); echo "</pre>"; exit;
            if($user_email){
                //echo $user;exit;
                $forum->user_id              = $user_email->id;
                $forum->title                = $question;
                $forum->total_publish_answer = '2';
                $forum->save();
            }
            else
            {
              $anonymous_user       = new User();
              $anonymous_user->name = 'Anonymous User';
              $anonymous_user->email= $email;
              $anonymous_user->logged_in_type = '2';
              $anonymous_user->password  = Hash::make('12345');
              $anonymous_user->save();

              $last_user = DB::table('users')->latest()->first();
              //echo "<pre>"; print_r($last_user); echo "</pre>"; exit;
              $forum->user_id              = $last_user->id;
              $forum->title                = $question;
              $forum->total_publish_answer = '2';
              $forum->save();
            }
        }
        else
        {
            $forum->user_id              = $user_id;
            $forum->title                = $question;
            $forum->total_publish_answer = '2';

        }


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
         //echo "<pre>"; print_r($question); echo "</pre>"; exit;
        return view('front.pages.single-pages.single-forum')->with(array(
            'site_title'   =>  'Quishi',
            'page_title'   =>  'Forum',
            'question'    =>  $question
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

    public function saveAnonmously(Request $request)
    {
        $question_id  = $request->input('question_id');
        $total_answers = ForumQuestionAnswer::where('forum_question_id',$question_id)->get();
        $checked_value= $request->input('post-anonymously');
        //echo "<pre>"; print_r($checked_value); echo "</pre>"; exit;

        $email        = $request->input('email');

        if($checked_value=='on'){
            $anonymous_email = User::where('email', '=', $email)->first();
            //echo "<pre>"; print_r($anonymous_email->email); echo "</pre>"; exit;
            if($anonymous_email){
                $answer                    = new ForumQuestionAnswer();
                $answer->forum_question_id = $question_id;
                $answer->user_id           = $anonymous_email->id;
                $answer->parent            = 0;
                $answer->content           = $request->input('answer');
                $answer->save();
            }
            else
            {
              $anonymous_user       = new User();
              $anonymous_user->name = 'Anonymous User';
              $anonymous_user->email= $email;
              $anonymous_user->logged_in_type = '2';
              $anonymous_user->password  = Hash::make('12345');
              $anonymous_user->save();

              $last_user = DB::table('users')->latest()->first();
              //echo "<pre>"; print_r($last_user); echo "</pre>"; exit;
              $answer                    = new ForumQuestionAnswer();
              $answer->forum_question_id = $question_id;
              $answer->user_id           = $last_user->id;
              $answer->parent            = 0;
              // if($total_answers->count()>0)
              //   {
              //    foreach ($total_answers as $total_answer) {
              //        # code...
              //       $answer->parent = $total_answer->forum_question_id;
              //    }
              //   }
              //   else
              //   {
              //    $answer->parent            = 0;
              //   }
              $answer->content           = $request->input('answer');
              $answer->save();
            }
        }
        //echo "<pre>"; print_r($user_id); echo "</pre>";exit;

        return response()->json(array('status'=>'success','result'=>'successfully replyed answer to  the question '),200);

    }

    public function saveLoggedin(Request $request)
    {
        $question_id  = $request->input('question_id');
        $user_id      = $request->input('user_id');
        $email        = $request->input('email');
        $total_answers = ForumQuestionAnswer::where('forum_question_id',$question_id)->get();
        $checked_value= $request->input('post-anonymously');

        //echo "<pre>"; print_r($user_id); echo "</pre>";exit;
        if($checked_value=='on'){
            $anonymous_email = User::where('email', '=', $email)->first();
            //echo "<pre>"; print_r($anonymous_email->email); echo "</pre>"; exit;
            if($anonymous_email){
                $answer                    = new ForumQuestionAnswer();
                $answer->forum_question_id = $question_id;
                $answer->user_id           = $anonymous_email->id;
                $answer->parent            = 0;
                $answer->content           = $request->input('answer');
                $answer->save();
            }
            else
            {
              $anonymous_user       = new User();
              $anonymous_user->name = 'Anonymous User';
              $anonymous_user->email= $email;
              $anonymous_user->logged_in_type = '2';
              $anonymous_user->password  = Hash::make('12345');
              $anonymous_user->save();

              $last_user = DB::table('users')->latest()->first();
              //echo "<pre>"; print_r($last_user); echo "</pre>"; exit;
              $answer                    = new ForumQuestionAnswer();
              $answer->forum_question_id = $question_id;
              $answer->user_id           = $last_user->id;
              $answer->parent            = 0;
              $answer->content           = $request->input('answer');
              $answer->save();
            }
        }
        else
        {
            $answer                    = new ForumQuestionAnswer();
            $answer->forum_question_id = $question_id;
            $answer->user_id           = $user_id;
            $answer->parent            = 0;
            $answer->content           = $request->input('answer');
            $answer->save();
        }

        return response()->json(array('status'=>'success','result'=>'successfully replyed answer to  the question '),200);


    }

    public function savePostAnonmously(Request $request)
    {
      echo "<pre>"; print_r($request->all()); echo "</pre>";exit;
        $question_id  = $request->input('question_id');
        $answer_id    = $request->input('answer_id');

        $checked_value= $request->input('post-anonymously');
        echo "<pre>"; print_r($checked_value); echo "</pre>"; exit;
        $email        = $request->input('post_email');
        //echo "<pre>"; print_r($email); echo "</pre>"; exit;
        if($checked_value=='on'){
            $anonymous_email = User::where('email', '=', $email)->first();

            if($anonymous_email){
                $answer                    = new ForumQuestionAnswer();
                $answer->forum_question_id = $question_id;
                $answer->user_id           = $anonymous_email->id;
                $answer->parent            = $answer_id;;
                $answer->content           = $request->input('post_answer');
                $answer->save();
            }
            else
            {
              $anonymous_user       = new User();
              $anonymous_user->name = 'Anonymous User';
              $anonymous_user->email= $email;
              $anonymous_user->logged_in_type = '2';
              $anonymous_user->password  = Hash::make('12345');
              $anonymous_user->save();

              $last_user = DB::table('users')->latest()->first();
              //echo "<pre>"; print_r($last_user); echo "</pre>"; exit;
              $answer                    = new ForumQuestionAnswer();
              $answer->forum_question_id = $question_id;
              $answer->user_id           = $last_user->id;
              $answer->parent            = $answer_id;

              $answer->content           = $request->input('post_answer');
              $answer->save();
            }
        }
        //echo "<pre>"; print_r($user_id); echo "</pre>";exit;

        return response()->json(array('status'=>'success','result'=>'successfully replyed answer to  the question '),200);
    }



}
