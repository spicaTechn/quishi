<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;

class ContactPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //displaying contact view with needed data


        // fetching contact data to pass id in hidden field of contact inquiry form
        $contact          = Page::where('slug','contact-us')->first();

        // check if contact data is in database or not. If not then pass dummy value to display in admin/cms/pages view top section
        if($contact):
            $contact_data = $contact;
        else:
            $contact_data             =  new Page();
            $contact_data->id         =  '';
            // return $contact_data;
        endif;

        return view('front.contact')
                    ->with(array(
                        'site_title'          => 'Quishi',
                        'page_title'          => 'Contact',
                        'contact'             => $contact_data,

                    )
                );
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
        //getting inquiry form data and saving to database in serialize form
        //echo "<pre>"; print_r($request->all()); echo "</pre>"; exit;
        // get hidden value to store inquiry form data in database with contact apge id
        $hidden_id = $request->contact_inquiry_id;


        $full_name  =   $request->input('full_name');
        $email      =   $request->input('email');
        $phone      =   $request->input('phone');
        $message    =   $request->input('message');

        $new_value  = array();

        $new_value['full_name']   = $full_name;
        $new_value['email']       = $email;
        $new_value['phone']       = $phone;
        $new_value['message']     = $message;



        $new_value_serialize     = serialize($new_value);


        $page_detail             = new PageDetail();
        $page_detail->page_id    = $hidden_id;
        $page_detail->meta_key   = 'contact-inquiry';
        $page_detail->meta_value = $new_value_serialize;
        $page_detail->save();

        return response()->json(array('status'=>'success','result'=>'successfully added the inquiry data in the quishi system'),200);
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
}
