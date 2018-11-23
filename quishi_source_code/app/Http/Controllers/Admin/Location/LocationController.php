<?php

namespace App\Http\Controllers\Admin\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Address;

class LocationController extends Controller
{

    protected $address;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.location.index')
            ->with([
                    'site_title'                =>'Quishi',
                    'page_title'                =>'Location',
                ]);
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

        $this->address               = new Address();
        $this->address->country      = $request->input('country');
        $this->address->state        = $request->input('state');
        $this->address->city         = $request->input('city');
        $this->address->status       = $request->input('status');

        //check for the same address in the database
        $full_address                = $request->input('city') .', '. $request->input('state') .' '. $request->input('country');
        $check_for_address           = Address::where('full_address',$full_address)->first();


        if($check_for_address):
             return response()->json(array('status'=>'dublicate','message'=>'Address Already exists in the Quishi system'),200);
        else:
            $this->address->full_address = $full_address;
            if($this->address->save()):
                //send the success message
                return response()->json(array('status'=>'success','message'=>'New location has been added to the Quishi'),200);
            else:
                //send the error message back
                return response()->json(array('status'=>'failed','message'=>'Location cannot be added to the Quishi'),200);
            endif;
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get the address by the id and return back to the client
        $address   = Address::findOrFail($id);
        return response()->json(array('status'=>'success','result'=> $address),200);
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
        $this->address                = Address::findOrFail($id);
        $this->address->country       = $request->input('country');
        $this->address->state         = $request->input('state');
        $this->address->city          = $request->input('city');
        $this->address->status        = $request->input('status');

        $full_address                = $request->input('city') .', '. $request->input('state') .' '. $request->input('country');
        $check_for_address           = Address::where('full_address',$full_address)->firstOrFail();

        if($check_for_address && $check_for_address->id != $id):
             return response()->json(array('status'=>'dublicate','message'=>'Address Already exists in the Quishi system'),200);
        else:
            $this->address->full_address = $full_address;
            $this->address->save();
            //return response back 
            return response()->json(array('status'=>'success','message'=>'Location has been updated'),200);
        endif;
        


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
        $this->address    = Address::findOrFail($id);
        if($this->address->users()->count() > 0):
            return response()->json(array('status'=>'failed','message'=> 'Locations cannot be deleted because career advisiors lives in this location'),200);
        else:
            if($this->address->delete()):
                return response()->json(array('status'=>'success','message'=>'Location has been deleted successfully!!'),200);
            else:
                return response()->json(array('status'=>'failed','message'=> 'Location cannot be deleted now please try again later'),200);
            endif;
        endif;

    }


    /**
     * Get search result stored in the database 
     *
     * @param \Illuminate\Http\Result
     * @return \Illuminate\Http\Response
     */

    public function getSearchLocation(Request $request){
      
        $search_input_value      = $request->input('_q');
        //check for the empty field or not
        if(!empty($search_input_value)):

            $search_type             = $request->input('type');
            $_autocomplete_result    = "";

            switch($search_type){
                case 1:
                 //country autocomplete
                 $_autocomplete_result     = Address::where('country','LIKE',"%{$search_input_value}%")->select('country as search_value')->distinct()->get();
                 break;
                case 2:
                 //state autocomplete
                 $_autocomplete_result   = Address::where('state','LIKE',"%{$search_input_value}%")->select('state as search_value')->distinct()->get();
                 break;
                case 3:
                 //city autocomplete
                 $_autocomplete_result = Address::where('city','LIKE',"%{$search_input_value}%")->select('city as search_value')->distinct()->get();
                 break;
                default:
                 break;
            }

           if($_autocomplete_result->count() > 0):
                $return_search_result   = view('admin.inc.search-result')->with(array('search_results'=>$_autocomplete_result))->render();
                //return response back to the client
                return response()->json(array('status'=>'success','message'=>$return_search_result),200);
           else:
                return response()->json(array('status'=>'failed','message'=>'No result found'),200);
           endif;
        else:
            //send the failure response back to the client
            return response()->json(array('status'=>'failed','message'=>'Search query empty'),200);
        endif;
    }


    /**
     * functions to get the locations
     * @param void
     * @return \Illuminate\Http\Response
     */

    public function getLocations(){
        $locations = Address::orderBy('created_at','desc')->select('addressess.*');
        return Datatables($locations)
                ->addColumn('status',function($location){
                    return ($location->status == 1) ? 'Active' : 'Inactive';
               })->addColumn('total_people_live_in',function($location){
                    return $location->users()->count();
               })->addColumn('action',function($location){
                $return_html = "";
                $return_html .= '<a href="#" class="m-r-15 text-muted edit-location" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-location-id="'.$location->id.'"><i class="icofont icofont-ui-edit"></i></a><a href="#" class="text-muted delete-location" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-location-id="'.$location->id.'"><i class="icofont icofont-delete-alt"></i></a>';
                return $return_html;
               })
                ->make("true");
    }
}
