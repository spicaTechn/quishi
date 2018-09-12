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
        $about = Page::where('slug','about-us')->first();
        // echo "<pre>"; print_r($about->page_detail); echo "</pre>";
        // exit;
        return view('admin.cms.pages.pages')
                ->with(array(
                    'site_title'=>'Quishi',
                    'page_title'=>'Pages',
                    'about' => $about)
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


    // updating about page top section
    public function aboutUpdate(Request $request, $id)
    {
        $this->about        =   Page::find($id);
        // echo "<pre>"; print_r($about->page_detail()); echo "</pre>";exit;
        $title              =   $this->about->title     = $request->input('about_title');
        $content            =   $this->about->content   = $request->input('about_description');
        if ($request->hasFile('about-image')) {
                $image = $request->file('about-image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = $this->image_path;
                $image->move($destinationPath, $name);
                foreach ($this->about->page_detail as $page_detail) {
                    $page_detail->meta_key = 'about-image';
                    $page_detail->meta_value = $name;
                    $page_detail->save();
                }


        }

        $this->about->save();

        // send the ajax reposne
        return response()->json(array('status'=>'success'),200);

    }
}
