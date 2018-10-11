<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use App\PageDetail;
use App\User;
use App\Model\UserProfile;
use App\Model\Tag;
use DB;

use Cartalyst\Stripe\Stripe;
use Stripe\Error\Card;


class MainPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetching contact data to show in footer section

        $blogs = Page::with('page_detail')->where('slug','blog')->orderBy('id', 'desc')->limit(2)->get();
        $blog  = $blogs ?? '';
        $user_profiles = UserProfile::where('status','1')->orderBy('profile_views','desc')->take(3)->get();
        $service      = Page::where('slug','home')->get();
        $home_video = Page::where('slug','home-video')->first();

        return view('front.index')
                    ->with(array(
                            'site_title'          => 'Quishi',
                            'page_title'          => 'Home',
                            'blogs'               => $blog,
                            'users_profile'       => $user_profiles,
                            'services'            => $service,
                            'home_video'          => $home_video
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

    public function getSocialMediaData()
    {
        $contact          = Page::where('slug','contact-us')->first();
        $contact_social  = PageDetail::where('page_id',$contact->id)
                                        ->where('meta_key','contact-us')
                                        ->first();
        $contact_social_data = unserialize($contact_social->meta_value);
        //echo "<pre>";print_r($contact_social_data); echo "</pre>";exit;
        return $contact_social_data;

    }



    //process the payment gatway request and make the payement here


    /**
    * fuunction to make the donation payment
    *
    * @param \Illuminate\Http\Request
    * @return \Illuminate\Http\Response
    *
    *
    **/

    public function makeDonationPayment(Request $request){

       //make the payment form here 
       
       try{
            $stripe = Stripe::make('sk_test_fHZhPEI4DHtnKAvE2DgG74xU');
            $token = $stripe->tokens()->create([
                'card' => [
                    'number'    => $request->input('card_number'),
                    'exp_month' => $request->input('expiration_month'),
                    'exp_year'  => $request->input('expiration_year'),
                    'cvc'       => $request->input('card_code'),
                ],
            ]);

            $charge   = $stripe->charges()->create([
                'amount'        => $request->input('amount'),
                'currency'      => $request->input('currency'),
                'source'        => $token['id'],
                'description'   => 'Donation received from '.$request->input('name_on_card')
            ]);
          if($charge['id']):
            return response()->json(array('status'=>'success','result'=>'Payment completed!!'),200);
          endif;
           
       }catch(\Cartalyst\Stripe\Exception\CardErrorException $e){

            return response()->json(array('status'=>'failed','result'=>$e->getMessage()),200);

       }catch(\Cartalyst\Stripe\Exception\BadRequestException $e){

        // This exception will be thrown when the data sent through the request is mal formed.
         return response()->json(array('status'=>'failed','result'=>$e->getMessage()),200);
       }catch(\Cartalyst\Stripe\Exception\UnauthorizedException $e){
        // This exception will be thrown if your Stripe API Key is incorrect.
         return response()->json(array('status'=>'failed','result'=>$e->getMessage()),200);
       }catch(\Cartalyst\Stripe\Exception\InvalidRequestException $e){
         // This exception will be thrown whenever the request fails for some reason.
         return response()->json(array('status'=>'failed','result'=>$e->getMessage()),200);
       }catch(\Cartalyst\Stripe\Exception\NotFoundException $e){
         // This exception will be thrown whenever a request results on a 404.
         return response()->json(array('status'=>'failed','result'=>$e->getMessage()),200);
       }catch(\Cartalyst\Stripe\Exception\ServerErrorException $e){
         // This exception will be thrown whenever Stripe does something wrong.
         return response()->json(array('status'=>'failed','result'=>$e->getMessage()),200);
       }catch(\Cartalyst\Stripe\Exception\MissingParameterException $e){
        // this exception will be thrown when some of the parameters missed for the stripe
         return response()->json(array('status'=>'failed','result'=>$e->getMessage()),200);
       }
       
       
    }
}
