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



        $about          = Page::where('slug','about-us')->first();
        // check if about data is in database or not. If not then pass empty value to display in about us  top section so tha error not occure
        if($about):
            $about_data = $about;
        else:
            $about_data             = new Page();
            $about_data->id         = '';
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


        $services = Page::where('slug','home')->get();
        if(count($services)>0){
            $home = $services;
        }
        else
        {
            for($i=0; $i<3; $i++){
                $home_save                = new Page();
                $home_save->title         = 'title';
                $home_save->content       = 'description';
                $home_save->slug          = 'home';
                $home_save->user_id       = Auth::user()->id;
                //echo "<pre>"; print_r($home_save); echo "</pre>"; exit;
                $home_save->save();

                $home_page_detail             = new PageDetail();
                $home_page_detail->meta_key   = 'home-icon';
                $home_page_detail->page_id    = $home_save->id;
                $home_page_detail->meta_value = 'hello.jpg';

                $home_page_detail->save();
            }
        }

        $home_video = Page::where('slug','home-video')->first();
        if(!empty($home_video))
        {
            $video_id = $home_video;
        }
        else
        {
            $video_id                = new Page();
            $video_id->title         = 'Home Video ID';
            $video_id->content       = 'https://www.youtube.com/embed/1jhkEtvH6s8';
            $video_id->slug          = 'home-video';
            $video_id->user_id       = Auth::user()->id;
            //echo "<pre>"; print_r($home_save); echo "</pre>"; exit;
            $video_id->save();
        }
        
        //new terms and conditions
        $terms_and_conditions = Page::where('slug','terms-conditions')->first();
        
        // new privacy policy
        $privacy_policy = Page::where('slug', 'privacy-policy')->first();

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

                    'contact'                     => $contact_data,
                    'home'                        => $home,
                    'home_video'                  => $video_id,
                    'terms_and_conditions'        => $terms_and_conditions,
                    'privacy_policy'              => $privacy_policy
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

    public function editHome(Request $request,$id)
    {
        $home_content = Page::find($id);
        $home_icon    = PageDetail::where('page_id',$home_content['id'])->first();
        //echo "<pre>";print_r($home_content); echo "<pre>";exit;

        $new_data = array();

        $new_data['id']             =   $home_icon['id'];
        $new_data['title']          =   $home_content['title'];
        $new_data['description']    =   $home_content['content'];
        $new_data['image']          =   $home_icon['meta_value'];

        return response()->json(array('result'=>$new_data,'status'=>'success'),200);

    }

    public function homeUpdate(Request $request, $id)
    {
        $user_id       = Auth::id();
        $id            = $request->input('home_id');
        $page_id       = $request->input('page_id');
        $home          = Page::find($id);
        $found_image   = false;

        //echo "<pre>";print_r($page_id); echo "<pre>";exit;
        $home->title         = $request->input('home_title');
        $home->content       = $request->input('home_description');
        $home->slug          = 'home';
        $home->user_id       = $user_id;
        $home->save();

        if($request->hasFile('home_icon')) {
            $image = $request->file('home_icon');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = $this->image_path;
            $image->move($destinationPath, $name);
            $team_image    = $name;
            $found_image   = true;

            foreach ($home->page_detail as $home_icon)
            {
                //echo "<pre>";print_r($home_icon); echo "</pre>";exit;
                if($home_icon['meta_value'] && ($home_icon['page_id'] == $id) )
                {
                        $path=$this->image_path.'/'.$home_icon['meta_value'];
                        File::delete($path);
                }
            }
        }



        if(!$found_image){
            foreach($home->page_detail as $home_icon){
                $name = $home_icon->meta_value;
            }
        }

        $page_detail             = PageDetail::find($page_id);
        $page_detail->meta_key   = 'home-icon';
        $page_detail->page_id    = $id;
        $page_detail->meta_value = $name;

        $page_detail->save();

        return response()->json(array('status'=>'success','result'=>'successfully updated blog in the quishi system'),200);

    }

    public function homeVideoIdUpdate(Request $request, $id)
    {
        $home_video_id          = Page::find($id);
        $user_id                = Auth::id();
        $home_video_id->title   = 'Home Video ID';
        $home_video_id->slug    = 'home-video';
        $home_video_id->content = $request->input('home_video');
        $home_video_id->user_id = $user_id;
        $home_video_id->save();
        return response()->json(array('status'=>'success','result'=>'successfully updated home video id in the quishi system'),200);

    }
    
    public function storeTerms(Request $request){
        //$hidden_id     = $request->about_page_id;
        $title         = $request->input('term_title');
        $slug          = str_slug($request->input('term_title')); 
        $description   = $request->input('term_description');
        
        
        //check page exists or not
        
        $new_terms = Page::where('slug','terms-conditions')->first();
        
        //if exists
        $i = 1;
        if($new_terms){
            $page_id = $new_terms->id;
        }else{
            //create new page
            $page        = new Page();
            $page->title = 'Terms & Conditions';
            $page->slug = 'terms-conditions';
            $page->content = "";
            $page->user_id = Auth::user()->id;
            $page->save();
            $page_id = $page->id;
            
            //store into page details
        }
        $stored_terms_details = array();
        //store into page details
        $terms = PageDetail::where('meta_key','terms')->first();
        if($terms){
            //unserialize the value meta value
            $existing_terms = unserialize($terms->meta_value);
            $j=1;
            //first stored the user entered value
            $stored_terms_details[$j]['id']          = $j;
            $stored_terms_details[$j]['title']       = $title;
            $stored_terms_details[$j]['slug']        = $slug;
            $stored_terms_details[$j]['description'] = $description;
            $j = 2;
            
            foreach($existing_terms as $existing_term){
                $stored_terms_details[$j]['id']          = $j;
                $stored_terms_details[$j]['title']       = $existing_term['title'];
                $stored_terms_details[$j]['slug']        = $existing_term['slug'];
                $stored_terms_details[$j]['description'] = $existing_term['description'];
                $j++;
            }
            
            
            //udate the exisitng one
            $new_terms_and_conditions = serialize($stored_terms_details);
            $terms_conditions_details = PageDetail::findOrFail($terms->id);
            $terms_conditions_details->meta_value = $new_terms_and_conditions;
            $terms_conditions_details->save();
            

        }else{
            
            $stored_terms_details[$i]['id']          = $i;
            $stored_terms_details[$i]['title']       = $title;
            $stored_terms_details[$i]['slug']        = $slug;
            $stored_terms_details[$i]['description'] = $description;
            
            //serilaize the value and stored in the db
            $new_terms_and_conditions = serialize($stored_terms_details);
            $terms_conditions_details = new PageDetail();
            $terms_conditions_details->page_id = $page_id;
            $terms_conditions_details->meta_key = "terms";
            $terms_conditions_details->meta_value = $new_terms_and_conditions;
            $terms_conditions_details->save();
            
            
        }
        
        
        
        //return response back to the client
        return response()->json(array('status'=>'success','message'=>''),200);
        
        
        
        
        
        
        
    }
    
    
    public function editTerm(Request $request,$term_id,$page_id){
        //get the page details by the page id
        $page_details = Page::findOrFail($page_id);
        //get the page details by the page_id
        $terms_details = $page_details->page_detail()->first()->meta_value;
        $page_detail_id = $page_details->page_detail()->first()->id;
        
        $edit_id       = $term_id;
        
        //unserialize the value
        $return_value = array();
        $terms_unserialize = unserialize($terms_details);
        foreach($terms_unserialize as $term_unserialize){
            if($term_unserialize['id']       == $term_id){
                $return_value['id']               = $term_id;
                $return_value['title']            = $term_unserialize['title'];
                $return_value['slug']             = $term_unserialize['slug'];
                $return_value['description']      = $term_unserialize['description'];
                $return_value['page_detail_id']   = $page_detail_id;
            }
        }
        
        //return back 
        return response()->json(array('status'=>'success','result'=>$return_value),200);
    }


    /**
     * update terms and conditions
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     *
     */


    public function updateTerm(Request $request){
        //update terms and conditions

        $term_id           = $request->input('term_id');
        $term_page_id      = $request->input('term_page_id');
        $term_page_details = Page::findOrFail($term_page_id);
        $term_details      = $term_page_details->page_detail()->first()->meta_value;
        $terms_unserialize = unserialize($term_details);

        //unset the term by term_id

        //unset($terms_unserialize[$term_id]);
        $update_term           = array();
        $array_key           = 0;
        foreach($terms_unserialize as $term){
            
            
            if($term['id'] == $term_id){
                 if($term['id']){
                    $array_key  = $term['id'];
                }
                $update_term[$term_id]['id']                = $term_id;
                $update_term[$term_id]['title']             = $request->input('term_title');
                $update_term[$term_id]['slug']              = str_slug($request->input('term_title'));
                $update_term[$term_id]['description']       = $request->input('term_description');
            }else{
                if($term['id']){
                    $array_key  = $term['id'];
                }
                $update_term[$array_key]['id']             = $term['id'];
                $update_term[$array_key]['title']          = $term['title'];
                $update_term[$array_key]['slug']           = $term['slug'];
                $update_term[$array_key]['description']    = $term['description'];
            }
        }


        //add the new updated details 
        


        //now serialize it 
        $updated_serialize_term = serialize($update_term);

        $page_details             = PageDetail::findOrFail($request->input('page_detail_id'));
        $page_details->meta_value = $updated_serialize_term;
        $page_details->save();

        return response()->json(array('status'=>'success'),200);




    }


    /**
     * delete a term and condition
     *
     * @param Illuminate\Http\Request
     * @return Illumiante\Http\Response
     *
     */


    public function deleteTerm(Request $request){
        //delete terms and conditions

        $term_id           = $request->input('term_id');
        $term_page_id      = $request->input('term_page_id');
        $term_page_details = Page::findOrFail($term_page_id);
        $term_details      = $term_page_details->page_detail()->first()->meta_value;
        $terms_unserialize = unserialize($term_details);

        //unset the term by term_id

        unset($terms_unserialize[$term_id]);

        $updated_serialize_term = serialize($terms_unserialize);

        $page_details             = PageDetail::findOrFail($term_page_details->page_detail()->first()->id);
        $page_details->meta_value = $updated_serialize_term;
        $page_details->save();

        return response()->json(array('status'=>'success'),200);
    }
    
    
    /*
        functions to CRUD privacy policy
    */
    public function storePrivacyPolicy(Request $request){
        //$hidden_id     = $request->about_page_id;
        $title         = $request->input('privacy_policy_title');
        $slug          = str_slug($request->input('privacy_policy_title')); 
        $description   = $request->input('privacy_policy_description');
        
        
        //check page exists or not
        
        $new_privacy_policy = Page::where('slug','privacy_policy')->first();
        
        //if exists
        $i = 1;
        if($new_privacy_policy){
            $page_id = $new_privacy_policy->id;
        }else{
            //create new page
            $page        = new Page();
            $page->title = 'Privacy Policy';
            $page->slug = 'privacy-policy';
            $page->content = "";
            $page->user_id = Auth::user()->id;
            $page->save();
            $page_id = $page->id;
            
            //store into page details
        }
        $stored_privacy_policy_details = array();
        //store into page details
        $privacy_policy = PageDetail::where('meta_key','privacy_policy')->first();
        if($privacy_policy){
            //unserialize the value meta value
            $existing_privacy_policy = unserialize($privacy_policy->meta_value);
            $j=1;
            //first stored the user entered value
            $stored_privacy_policy_details[$j]['id']          = $j;
            $stored_privacy_policy_details[$j]['title']       = $title;
            $stored_privacy_policy_details[$j]['slug']        = $slug;
            $stored_privacy_policy_details[$j]['description'] = $description;
            $j = 2;
            
            foreach($existing_privacy_policy as $existing_privacy){
                $stored_privacy_policy_details[$j]['id']          = $j;
                $stored_privacy_policy_details[$j]['title']       = $existing_privacy['title'];
                $stored_privacy_policy_details[$j]['slug']        = $existing_privacy['slug'];
                $stored_privacy_policy_details[$j]['description'] = $existing_privacy['description'];
                $j++;
            }
            
            
            //udate the exisitng one
            $new_privacy_policy = serialize($stored_privacy_policy_details);
            $privacy_policy_details = PageDetail::findOrFail($privacy_policy->id);
            $privacy_policy_details->meta_value = $new_privacy_policy;
            $privacy_policy_details->save();
            

        }else{
            
            $stored_privacy_policy_details[$i]['id']          = $i;
            $stored_privacy_policy_details[$i]['title']       = $title;
            $stored_privacy_policy_details[$i]['slug']        = $slug;
            $stored_privacy_policy_details[$i]['description'] = $description;
            
            //serilaize the value and stored in the db
            $new_privacy_policy = serialize($stored_privacy_policy_details);
            $privacy_policy_details = new PageDetail();
            $privacy_policy_details->page_id = $page_id;
            $privacy_policy_details->meta_key = "privacy_policy";
            $privacy_policy_details->meta_value = $new_privacy_policy;
            $privacy_policy_details->save();
            
            
        }
        
        //return response back to the client
        return response()->json(array('status'=>'success','message'=>''),200);
        
    }
    
    
    public function editPrivacyPolicy(Request $request,$privacy_policy_id,$page_id){
        //get the page details by the page id
        $page_details = Page::findOrFail($page_id);
        //get the page details by the page_id
        $privacy_policy_details = $page_details->page_detail()->first()->meta_value;
        $page_detail_id = $page_details->page_detail()->first()->id;
        
        $edit_id       = $privacy_policy_id;
        
        //unserialize the value
        $return_value = array();
        $privacy_policies_unserialize = unserialize($privacy_policy_details);
        foreach($privacy_policies_unserialize as $privacy_policy_unserialize){
            if($privacy_policy_unserialize['id']       == $privacy_policy_id){
                $return_value['id']               = $privacy_policy_id;
                $return_value['title']            = $privacy_policy_unserialize['title'];
                $return_value['slug']             = $privacy_policy_unserialize['slug'];
                $return_value['description']      = $privacy_policy_unserialize['description'];
                $return_value['page_detail_id']   = $page_detail_id;
            }
        }
        
        //return back 
        return response()->json(array('status'=>'success','result'=>$return_value),200);
    }


    /**
     * update Privacy Policy
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     *
     */


    public function updatePrivacyPolicy(Request $request){
        //update terms and conditions

        $privacy_policy_id = $request->input('privacypolicy_id');
        $privacy_policy_page_id      = $request->input('privacypolicy_page_id');
        $privacy_policy_page_details = Page::findOrFail($privacy_policy_page_id);
        $privacy_policy_details      = $privacy_policy_page_details->page_detail()->first()->meta_value;
        $privacy_policy_unserialize = unserialize($privacy_policy_details);

        //unset the term by term_id

        //unset($privacy_policy_unserialize[$privacy_policy_id]);
        $update_privacy_policy = array();
        $array_key           = 0;
        foreach($privacy_policy_unserialize as $privacy_policy){
            
            //check for the update key
            
            if($privacy_policy['id'] == $privacy_policy_id){
                 $array_key  = $privacy_policy['id'];
                 $update_privacy_policy[$array_key]['id']                = $privacy_policy_id;
                 $update_privacy_policy[$array_key]['title']             = $request->input('privacy_policy_title');
                 $update_privacy_policy[$array_key]['slug']              = str_slug($request->input('privacy_policy_title'));
                 $update_privacy_policy[$array_key]['description']       = $request->input('privacy_policy_description');
                
            }else{
                if($privacy_policy['id']){
                $array_key  = $privacy_policy['id'];
                }
                $update_privacy_policy[$array_key]['id']             = $privacy_policy['id'];
                $update_privacy_policy[$array_key]['title']          = $privacy_policy['title'];
                $update_privacy_policy[$array_key]['slug']           = $privacy_policy['slug'];
                $update_privacy_policy[$array_key]['description']    = $privacy_policy['description'];
            }
            
 
        }

        //add the new updated details 
       


        //now serialize it 
        $updated_serialize_privacy_policy = serialize($update_privacy_policy);

        $page_details             = PageDetail::findOrFail($request->input('page_detail_id'));
        $page_details->meta_value = $updated_serialize_privacy_policy;
        $page_details->save();

        return response()->json(array('status'=>'success'),200);

    }


    /**
     * delete a term and condition
     *
     * @param Illuminate\Http\Request
     * @return Illumiante\Http\Response
     *
     */


    public function deletePrivacyPolicy(Request $request){
        //delete terms and conditions

        $privacy_policy_id = $request->input('privacy_policy_id');
        $privacy_policy_page_id      = $request->input('privacy_policy_page_id');
        $privacy_policy_page_details = Page::findOrFail($privacy_policy_page_id);
        $privacy_policy_details      = $privacy_policy_page_details->page_detail()->first()->meta_value;
        $privacy_policies_unserialize = unserialize($privacy_policy_details);

        //unset the term by term_id

        unset($privacy_policies_unserialize[$privacy_policy_id]);

        $updated_serialize_privacy_policy = serialize($privacy_policies_unserialize);

        $page_details             = PageDetail::findOrFail($privacy_policy_details->page_detail()->first()->id);
        $page_details->meta_value = $updated_serialize_privacy_policy;
        $page_details->save();

        return response()->json(array('status'=>'success'),200);
    }



}
