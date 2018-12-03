<?php

namespace App\Http\Controllers\Front\CareerAdvisor\Notification;

use Illuminate\Http\Request;
use App\Model\Notification;
use App\Http\Controllers\Controller;
use Auth,DB;
use Carbon\Carbon;

class NotificationController extends Controller
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



    /**
     * function to mark the all notification of the career advisor as seen notifications
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */

    public function markAsSeen(Request $request){
       $notifiable_id  = Auth::user()->id;
       $affected       = DB::table('notifications')->where('seen_flag','0')
                                                   ->where('notifiable_id',$notifiable_id)
                                                   ->update(array('seen_flag' =>'1'));
       if($affected > 0){
        return response()->json(array('status'=> 'success','message'=> 'Record has been updated successfully!!'),200);
       }
    }



    /** 
     * function to mark the notification as the read notification
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     *
     */

    public function markAsRead(Request $request){

        $current_click_notification = Notification::findOrFail($request->input('_quishi_notification_id'));

        $current_click_notification->read_at = new Carbon();
        $current_click_notification->save();

        //return response back to the client

        return response()->json(array('status'=>'success','message'=>'Notification has been udpated!!'),200);
    }


    /**
     * function to mark all the notifications of the currently logged in users as read
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function markAllAsRead(Request $request){

        $notifiable_id                = Auth::user()->id;
        $mark_career_advisior_as_read = DB::table('notifications')->where('notifiable_id',$notifiable_id)
                                                                  ->update(array('read_at' => new Carbon()));
        if($mark_career_advisior_as_read > 0){
            return response()->json(array('status'=>'success','message'=> 'Notifications has been updated!!'),200);
        }else{
            return response()->json(array('status'=>'failed','message'=> 'Notification cannot be updated!!'),200);
        }
    }
}
