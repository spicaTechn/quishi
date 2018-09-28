<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Page;
use App\PageDetail;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $contact_data = array();
        $contact          = Page::where('slug','contact-us')->first();
        if($contact):
            $contact_social   = PageDetail::where('page_id',$contact->id)
                                        ->where('meta_key','contact-us')
                                        ->first();
            if($contact_social):

                $contact_data = unserialize($contact_social->meta_value);
            endif;
        endif;
        View::share('contact_social', $contact_data);

        View::share('site_title','Quishi');
        View::share('page_title','Online Career Seeker')
;    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
