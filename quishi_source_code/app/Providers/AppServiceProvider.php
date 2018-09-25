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
        $contact          = Page::where('slug','contact-us')->first();
        $contact_social   = PageDetail::where('page_id',$contact->id)
                                        ->where('meta_key','contact-us')
                                        ->first();
        $contact_data = unserialize($contact_social->meta_value);
        View::share('contact_social', $contact_data);
    }

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
