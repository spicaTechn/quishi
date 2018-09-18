<?php

namespace App\Http\Controllers\Admin\Cms\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageDetail;

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
        $about_image    = PageDetail::where('meta_key','about-us-image')->first();
        $about_our_team = PageDetail::where('meta_key','our-team')->first();
        if($about_our_team):
            $about_our_team_id          = $about_our_team->id;
            $about_our_team_unserialize = unserialize($about_our_team->meta_value);
        else:
            $about_our_team_id = '';
            $about_our_team_unserialize = array();
        endif;


        // echo "<pre>"; print_r($about_our_team_unserialize); echo "</pre>";
        // exit;

        return view('admin.cms.pages.pages')
                ->with(array(
                    'site_title'     =>'Quishi',
                    'page_title'     =>'Pages',
                    'about'          => $about,
                    'about_image'    => $about_image,


                    'page_detail_id'              => $about_our_team_id,
                    'about_our_team_unserializes' => $about_our_team_unserialize
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

        // $new_team_members = serialize($new_team);

        // $page_detail             = PageDetail::findOrFail($page_details_id);

        $page_detail->meta_key   = 'our-team';
        $page_detail->page_id    = 1;
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
        $this->about        =   Page::find($id);
        $page_id            =   $this->about->id;
        //echo "<pre>"; print_r($this->about->id); echo "</pre>";exit;
        $title              =   $this->about->title     = $request->input('about_title');
        $slug               =   $this->about->slug      = str_slug($request->input('about_title'));
        $content            =   $this->about->content   = $request->input('about_description');
        if ($request->hasFile('about-image')) {
                $image = $request->file('about-image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = $this->image_path;
                $image->move($destinationPath, $name);

                // echo "<pre>"; print_r($page_detail); echo "</pre>";exit;
                $page_detail = PageDetail::find($page_id);
                $page_detail->meta_key = $slug.'-'.'image';
                $page_detail->meta_value = $name;
                $page_detail->save();

        }

        $this->about->save();

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
        $page_detail->page_id    = 1;
        $page_detail->meta_value = $new_team_members;

        $page_detail->save();

        return response()->json(array('status'=>'success','result'=>'successfully added the our team in the quishi system'),200);

    }

    public function deleteOurTeam(Request $request, $id)
    {
        $teams                  = PageDetail::findOrFail($id);
        $team_unseralize        = unserialize($teams->meta_value);

        unset($team_unseralize[$request->individual_id]);

        //echo "<pre>"; print_r($team_unseralize); echo "</pre>";exit;
        $page_details_id     = $teams->id;
        // $array_key           = 0;


        // foreach($team_unseralize as $our_team){

        //     if($our_team['id']){
        //         $array_key = $our_team['id'];
        //     }
        //     $new_team[$array_key]['id']             = $our_team['id'];
        //     $new_team[$array_key]['title']          = $our_team['title'];
        //     $new_team[$array_key]['description']    = $our_team['description'];
        //     $new_team[$array_key]['slug']           = $our_team['slug'];
        //     $new_team[$array_key]['position']       = $our_team['position'];
        //     $new_team[$array_key]['image']          = $our_team['image'];

        // }
        //echo "<pre>"; print_r($new_team); echo "</pre>";exit;


        $new_team_members = serialize($team_unseralize);
        $page_detail             = PageDetail::findOrFail($page_details_id);
        $page_detail->meta_key   = 'our-team';
        $page_detail->page_id    = 1;
        $page_detail->meta_value = $new_team_members;

        $page_detail->save();

        return response()->json(array('status'=>'success','result'=>'successfully added the our team in the quishi system'),200);
    }

}
