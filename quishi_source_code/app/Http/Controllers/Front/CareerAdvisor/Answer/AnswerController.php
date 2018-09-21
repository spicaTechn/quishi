<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Answer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    //
    public function index(){

    	 return view('front.career-advisor.answer.answer');
    }
}
