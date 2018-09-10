<?php

namespace App\Http\Controllers\Front\CareerAdvisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CareerAdvisotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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

    public function profile()
    {
        return view('front.career-advisor.my-profile');
    }

    public function profileLogin()
    {
        return view('front.career-advisor.my-profile-login');
    }
    public function profileAccount()
    {
        return view('front.career-advisor.profile-account');
    }
    public function profileSetupOne()
    {
        return view('front.career-advisor.profole-setup-1');
    }
    public function profileSetupTwo()
    {
        return view('front.career-advisor.profole-setup-2');
    }
    public function profileSetupThree()
    {
        return view('front.career-advisor.profole-setup-3');
    }
    public function questionAdminReview()
    {
        return view('front.career-advisor.question-admin-review');
    }
    public function questionAnsEdit()
    {
        return view('front.career-advisor.question-ans-edit');
    }
}
