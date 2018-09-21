<?php

namespace App\Http\Controllers\Admin\Cms\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;
use Input,Session,Hash,Image,Validator,File,Auth;
use App\Libraries\Filehelpers;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $image_path='front/images/pages';

    public function index()
    {
        //
        $about          = Page::where('slug','about-us')->first();

        // check if about data is in database or not. If not then pass empty value to display in about us  top section so tha error not occure
        if($about):
            $about_data = $about;
        else:
            $about_data             =  new Page();
            $about_data->id         =  '';
            $about_data->title      = '';
            $about_data->content    = '';
            $about_data->user_id    = '';
            $about_data->slug       = '';
            //return $about_data;
        endif;


        $about_image         = PageDetail::where('meta_key','about-us-image')->first();
        // check if about_image is set or not if not the pass dummy value to show in admin/pages view top section
        if($about_image):
            $about_image_data = $about_image;
        else:
            $about_image_data             = new PageDetail();
            $about_image_data->meta_value = 'about-us-image';
            $about_image_data->meta_value = 'blog1.jpg';
        endif;



        $about_our_team = PageDetail::where('meta_key','our-team')->first();
        // check if about us our team section is empty or not if empty then set value to null
        if($about_our_team):
            $about_our_team_id          = $about_our_team->id;
            $about_our_team_unserialize = unserialize($about_our_team->meta_value);
        else:
            $about_our_team_id = '';
            $about_our_team_unserialize = array();
        endif;



        //contact us top section
        $contact          = Page::where('slug','contact-us')->first();

        // check if contact data is in database or not. If not then pass dummy value to display in admin/cms/pages view top section
        if($contact):
            $contact_data = $contact;
        else:
            $contact_data             =  new Page();
            $contact_data->id         =  '';
            $contact_data->title      = 'Lorem ispum';
            $contact_data->content    = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum voluptatem modi ducimus aut voluptatum voluptates voluptate dolores consectetur laudantium placeat. Quibusdam natus accusantium enim quos assumenda repudiandae porro sit, rem.';
            $contact_data->user_id    = '1';
            $contact_data->slug       = 'contact-us';
            //return $about_data;
        endif;

        // contact us social media content
        $contact_social     =   PageDetail::where('meta_key','contact-us')->first();
        // check if value is set in database or not if not then send empty value to respective views of contact us socila section
        if($contact_social):
            $contact_social_id          = $contact_social->id;
            $contact_social_unserialize = unserialize($contact_social->meta_value);
        else:
            $contact_social_id = '';
            $contact_social_unserialize['address']     = '';
            $contact_social_unserialize['phone_number']= '';
            $contact_social_unserialize['email']       = '';
            $contact_social_unserialize['facebook']    = '';
            $contact_social_unserialize['twitter']     = '';
            $contact_social_unserialize['google_plus'] = '';
            $contact_social_unserialize['instragram']  = '';
        endif;

        //echo "<pre>"; print_r($contact_social_unserialize['address']); echo "</pre>";exit;

        return view('admin.cms.pages.pages')
                ->with(array(
                    'site_title'          =>'Quishi',
                    'page_title'          =>'Pages',
                    'about'               => $about_data,
                    'about_image'         => $about_image_data,

                    'page_detail_id'              => $about_our_team_id,
                    'about_our_team_unserializes' => $about_our_team_unserialize,
                    'contact_page_detail_id'      => $contact_social_id,
                    'contact_social_unserialize'  => $contact_social_unserialize,

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
        //Storing about us our team
        // echo "<pre>"; print_r($request->all()); echo "</pre>";
        // exit;
        $hidden_id = $request->about_page_id;

        $title         = $request->input('team_title');
        $slug          = str_slug($request->input('team_title'));
        $description   = $request->input('team_description');
        $team_position = $request->input('team_position');

        if($request->hasFile('team_image')) {
            $image = $request->file('team_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = $this->image_path;
            $image->move($destinationPath, $name);
            $team_image    = $name;
        }



        $get_our_team   = PageDetail::where('meta_key','our-team')->get();
        //echo "<pre>"; print_r($get_our_team); echo "</pre>";
        $new_team = array();
        $i = 1;

        if($get_our_team->count() > 0){
            foreach($get_our_team as $team){
                $get_our_team_meta_value = $team->meta_value;
                $page_details_id = $team->id;

            }


            $our_team_unseralize     = unserialize($get_our_team_meta_value);


            foreach($our_team_unseralize as $our_team){
                $new_team[$i]['id']             = $our_team['id'];
                $new_team[$i]['title']          = $our_team['title'];
                $new_team[$i]['description']    = $our_team['description'];
                $new_team[$i]['slug']           = $our_team['slug'];
                $new_team[$i]['position']       = $our_team['position'];
                $new_team[$i]['image']          = $our_team['image'];
                $i++;
            }
            $new_team[$i]['id']          = $i;
            $new_team[$i]['title']       = $title;
            $new_team[$i]['description'] = $description;
            $new_team[$i]['slug']        = $slug;
            $new_team[$i]['position']    = $team_position;
            $new_team[$i]['image']       = $team_image;


            $new_team_members = serialize($new_team);
            $page_detail             = PageDetail::findOrFail($page_details_id);


        }else{
            $new_team[$i]['id']          = $i;
            $new_team[$i]['title']       = $title;
            $new_team[$i]['description'] = $description;
            $new_team[$i]['slug']        = $slug;
            $new_team[$i]['position']    = $team_position;
            $new_team[$i]['image']       = $team_image;

            $new_team_members = serialize($new_team);
            $page_detail      = new PageDetail();

        }


        $page_detail->page_id    = $hidden_id;
        $page_detail->meta_key   = 'our-team';
        $page_detail->meta_value = $new_team_members;
        $page_detail->save();

        return response()->json(array('status'=>'success','result'=>'successfully added the our team in the quishi system'),200);

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


    // updating about page top section
    public function aboutUpdate(Request $request, $id)
    {
        $hidden_id = $request->about_id;
        if($hidden_id>0)
        {
            $this->about        =   Page::find($hidden_id);
            //echo "<pre>"; print_r($this->about); echo "</pre>";exit;
            //File::delete;


            $page_id            =   $this->about->id;

            $title              =   $this->about->title     = $request->input('about_title');
            $slug               =   $this->about->slug      = 'about-us';
            $content            =   $this->about->content   = $request->input('about_description');
            if ($request->hasFile('about-image')) {
                    $image = $request->file('about-image');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = $this->image_path;
                    $image->move($destinationPath, $name);

                    // echo "<pre>"; print_r($page_detail); echo "</pre>";exit;
                    $page_detail = PageDetail::where('page_id',$hidden_id)->first();
                    //echo "<pre>"; print_r($page_detail); echo "</pre>";exit;
                    // if page_id is not found the set page_id to $hidden id
                    if($page_detail->meta_value)
                    {
                        $path=$this->image_path.'/'.$page_detail->meta_value;
                        File::delete($path);
                    }
                    if($page_detail)
                    {
                        $page_detail->meta_key   = 'about-us-image';
                        $page_detail->meta_value = $name;
                        $page_detail->save();
                    }
                    else
                    {
                        $page_detail             = new PageDetail();
                        $page_detail->page_id    = $hidden_id;
                        $page_detail->meta_key   = 'about-us-image';
                        $page_detail->meta_value = $name;
                        $page_detail->save();
                    }


            }

            $this->about->save();
        }
        else
        {
            $about_data             = new Page();
            $about_data->title      = $request->input('about_title');
            $about_data->content    = $request->input('about_description');
            $about_data->slug       = 'about-us';
            $about_data->user_id    = '1';
            $about_data->save();

            if ($request->hasFile('about-image')) {
                    $image = $request->file('about-image');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = $this->image_path;
                    $image->move($destinationPath, $name);

                    // echo "<pre>"; print_r($page_detail); echo "</pre>";exit;
                    $page_detail = new PageDetail();

                    $page_detail->page_id = $about_data->id;
                    $page_detail->meta_key   = 'about-us-image';
                    $page_detail->meta_value = $name;
                    $page_detail->save();


                    $about_data->page_detail()->save($page_detail);

            }


        }

        // send the ajax reposne
        return response()->json(array('status'=>'success'),200);

    }


    public function editOurTeam(Request $request, $id)
    {

        $members   = PageDetail::findOrFail($id);
        // $data_id = $_POST['hiddenVal'];
        $member_unserialize = unserialize($members->meta_value);
        //echo "<pre>"; print_r($member_unserialize); echo "</pre>";
        $new_team = array();

        foreach ($member_unserialize as $value) {
            if($value['id'] == $request->edit_id){
                $new_team['id']             =   $value['id'];
                $new_team['title']          =   $value['title'];
                $new_team['slug']           =   $value['slug'];

                $new_team['description']    =   $value['description'];
                $new_team['position']       =   $value['position'];
                $new_team['image']          =   $value['image'];

            }
            //echo "<pre>"; print_r($new_team); echo "</pre>";

        }

        return response()->json(array('result'=>$new_team,'status'=>'success'),200);
    }

    public function updateOurTeam(Request $request, $id)
    {
        $hidden_id = $request->about_page_id;

        $title         = $request->input('team_title');
        $slug          = str_slug($request->input('team_title'));
        $description   = $request->input('team_description');
        $team_position = $request->input('team_position');
        $team_image    = '';
        $found_image   = false;
        if($request->hasFile('our_team_image')) {
            $image = $request->file('our_team_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = $this->image_path;
            $image->move($destinationPath, $name);
            $team_image    = $name;
            $found_image   = true;
        }

        $new_team = array();
        $i = 1;

        $teams               = PageDetail::findOrFail($id);
        $team_unseralize     = unserialize($teams->meta_value);



        if(!$found_image){
            foreach($team_unseralize as $team_member){
                if($team_member['id'] == $request->individual_id){
                    $team_image = $team_member['image'];
                }
            }
        }

        foreach ($team_unseralize as $value)
        {
            //echo "<pre>";print_r($value['id']); echo "</pre>";exit;
            if($value['image'] && ($value['id'] == $request->individual_id) )
                {
                    $path=$this->image_path.'/'.$value['image'];
                    File::delete($path);
                }
        }

        unset($team_unseralize[$request->individual_id]);
        $page_details_id     = $teams->id;
        $array_key           = 0;

        foreach($team_unseralize as $our_team){

            if($our_team['id']){
                $array_key = $our_team['id'];
            }
            $new_team[$array_key]['id']             = $our_team['id'];
            $new_team[$array_key]['title']          = $our_team['title'];
            $new_team[$array_key]['description']    = $our_team['description'];
            $new_team[$array_key]['slug']           = $our_team['slug'];
            $new_team[$array_key]['position']       = $our_team['position'];
            $new_team[$array_key]['image']          = $our_team['image'];



        }

        $new_team[$request->individual_id]['id']  = $request->individual_id;
        $new_team[$request->individual_id]['title'] = $title;
        $new_team[$request->individual_id]['description'] = $description;
        $new_team[$request->individual_id]['slug']        = $slug;
        $new_team[$request->individual_id]['position']    = $team_position;
        $new_team[$request->individual_id]['image']       = $team_image;

        $new_team_members = serialize($new_team);
        $page_detail             = PageDetail::findOrFail($page_details_id);
        $page_detail->meta_key   = 'our-team';
        $page_detail->page_id    = $hidden_id;
        $page_detail->meta_value = $new_team_members;

        $page_detail->save();

        return response()->json(array('status'=>'success','result'=>'successfully added the our team in the quishi system'),200);

    }

    public function deleteOurTeam(Request $request, $id)
    {
        $hidden_id = $request->hidden_id;
        //echo "<pre>"; print_r($hidden_id); echo "</pre>";exit;
        $teams                  = PageDetail::findOrFail($id);
        $team_unseralize        = unserialize($teams->meta_value);
        foreach ($team_unseralize as $value)
        {
            if($value['image'])
                {
                    $path=$this->image_path.'/'.$value['image'];
                    File::delete($path);
                }
        }


        unset($team_unseralize[$request->individual_id]);

        //echo "<pre>"; print_r($team_unseralize); echo "</pre>";exit;
        $page_details_id     = $teams->id;


        $new_team_members = serialize($team_unseralize);
        $page_detail             = PageDetail::findOrFail($page_details_id);
        $page_detail->meta_key   = 'our-team';
        $page_detail->page_id    = $hidden_id;
        $page_detail->meta_value = $new_team_members;

        $page_detail->save();

        return response()->json(array('status'=>'success','result'=>'successfully added the our team in the quishi system'),200);
    }


    public function contactUpdate(Request $request, $id)
    {
        $hidden_id = $request->contact_id;
        if($hidden_id>0)
        {
            $this->contact        =   Page::find($hidden_id);
            // echo "<pre>"; print_r($this->about); echo "</pre>";exit;
            $page_id            =   $this->contact->id;

            $title              =   $this->contact->title     = $request->input('contact_title');
            $slug               =   $this->contact->slug      = 'contact-us';
            $content            =   $this->contact->content   = $request->input('contact_description');

            $this->contact->save();
        }
        else
        {
            $contact_data             = new Page();
            $contact_data->title      = $request->input('contact_title');
            $contact_data->content    = $request->input('contact_description');
            $contact_data->slug       = 'contact-us';
            $contact_data->user_id    = '1';
            $contact_data->save();

        }

        // send the ajax reposne
        return response()->json(array('status'=>'success'),200);
    }



    public function contactSocialUpdate(Request $request)
    {

        $hidden_id       = $request->contact_social_id;
        $contact_page_id = $request->contact_page_id;
        // echo "<pre>"; print_r($id); echo "</pre>";exit;
        $address        = $request->input('address');
        $phone          = $request->input('phone_number');
        $email          = $request->input('email');
        $facebook       = $request->input('facebook');
        $twitter        = $request->input('twitter');
        $google_plus    = $request->input('google_plus');
        $instragram     = $request->input('instragram');

        if($contact_page_id)
        {
            $contact               = PageDetail::findOrFail($contact_page_id);
            $contact_unseralize    = unserialize($contact->meta_value);


            //echo "<pre>"; print_r($contact_unseralize); echo "</pre>";exit;
            $contact_unseralize['address']     = $address;
            $contact_unseralize['phone_number']= $phone;
            $contact_unseralize['email']       = $email;
            $contact_unseralize['facebook']    = $facebook;
            $contact_unseralize['twitter']     = $twitter;
            $contact_unseralize['google_plus'] = $google_plus;
            $contact_unseralize['instragram']  = $instragram;

            $new_contact_data     = serialize($contact_unseralize);
            $page_detail          = PageDetail::findOrFail($contact_page_id);

        }
        else
        {
            $new_value = array();

            $new_value['address']     = $address;
            $new_value['phone_number']= $phone;
            $new_value['email']       = $email;
            $new_value['facebook']    = $facebook;
            $new_value['twitter']     = $twitter;
            $new_value['google_plus'] = $google_plus;
            $new_value['instragram']  = $instragram;

            $new_contact_data = serialize($new_value);
            $page_detail       = new PageDetail();
        }


        $page_detail->page_id    = $hidden_id;
        $page_detail->meta_key   = 'contact-us';
        $page_detail->meta_value = $new_contact_data;
        $page_detail->save();

        return response()->json(array('status'=>'success','result'=>'successfully added the our team in the quishi system'),200);



    }
}
