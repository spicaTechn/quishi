<?php

namespace App\Http\Controllers\Front\Pages\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;
use Validation;
use Session;

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

        return view('front.pages.contact.contact')
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
         $validatedData = $request->validate([
            'email' => ['required','regex:/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'],
        ]);

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
        //$page_detail->save();

        Session::flash('new_query_success','Thank you for your query we will contact as soon as possible');

        return redirect()->route('contact');

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
}
