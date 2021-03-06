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
use App\Model\Post;
use App\Model\Address;
use App\Model\Career;

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

        $medias = Post::where('type','2')->limit(4)->get();
        $popular_blogs = Post::orderBy('total_like_counts','desc')->where('type','1')->limit(4)->get();
        $user_profiles = UserProfile::where('status','1')->where('profile_setup_status','1')->orderBy('profile_views','desc')->take(3)->get();
        $service      = Page::where('slug','home')->get();
        $home_video = Page::where('slug','home-video')->first();
        

        return view('front.index')
                    ->with(array(
                            'site_title'          => 'Quishi',
                            'page_title'          => 'Home',
                            'blogs'               => $medias,
                            'popular_blogs'       => $popular_blogs,
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


    /**
     * function to show the search option by the user location search
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     *
     */ 


    public function autocompleteByLocation(Request $request){
        $search_query   = $request->input('q');
        $search_query   = str_replace(","," ",$search_query);

        //make requst to DBMS
            $search_results = Address::where(function($query) use($request,$search_query){
                                        if($request->has('q') && $request->input('q') != ""):
                                            $query->where('full_address','LIKE',"%{$search_query}%");
                                        endif;
                                        })
                                      ->orderBy('created_at','desc')
                                      ->where('status','1')
                                      ->limit(7)
                                      ->select('full_address','city','state','country')
                                      ->get();
            if($search_results->count() > 0):
                //send the success message to the client along with the results
                return response()->json(array('status'=>'success','result' => $search_results ),200);
            else:
                //return failed response back to the client along with the message
                return response()->json(array('status'=>'failed','message'=>'There are no matching records found in the quishi system'),200);
            endif;
        
    }



    /**
     * function to show the search option by the user job title search
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     *
     */


    public function autocompleteByJobTitle(Request $request){

        $search_query    = $request->input('q');

            $search_results = Career::where('parent','>' , 0)
                                    ->where(function($query) use($request,$search_query){
                                        if($request->has('q') && $request->get('q') != ""):
                                            $query->where('title','LIKE',"%{$search_query}%");
                                        endif;
                                    })
                                    ->orderBy('created_at','desc')
                                    ->where('status','1')
                                    ->where('is_approved','1')
                                    ->limit(7)
                                    ->select('title')
                                    ->get();
            if($search_results->count() > 0):
                return response()->json(array('status'=>'success','result'=>$search_results),200);
            else:
                //return failed
                return response()->json(array('status'=>'failed','message'=>'No job title matches'),200);
            endif;
    }


    /**
     * function to show the search option by the user job title search
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     *
     */


    public function privacy(Request $request){
        $privacy_policy = Page::where('slug','privacy-policy')->first();
            return view('front.pages.privacy-policy.index')
            ->with(array(
                    'site_title'          => 'Quishi',
                    'page_title'          => 'privacy policy',
                    'privacy_policy'      => $privacy_policy
                   
                )
            );
        
    }

    /**
     * function to show the search option by the user job title search
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     *
     */


    public function terms(Request $request){
    //new terms and conditions
    $terms_and_conditions = Page::where('slug','terms-conditions')->first();
    return view('front.pages.terms-condition.index')
        ->with(array(
                'site_title'          => 'Quishi',
                'page_title'          => 'terms and conditions',
                'terms_and_conditions' => $terms_and_conditions
            )
        );
        
    }

}
