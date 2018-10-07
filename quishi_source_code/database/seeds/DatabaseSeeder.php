<?php

use Illuminate\Database\Seeder;
use App\Page;
use App\PageDetail;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
     public $image_path='front/images/blogs';
    public function run()
    {
        // $this->call(UsersTableSeeder::class);



    	$home = new Page();
        $home->title      = 'home_title';
        $home->content    = 'home_description';
        $home->slug       = 'home';
        $home->user_id    = '1';
        $home->save();

        $page_detail = new PageDetail();

        $page_detail->page_id   = $home->id;
        $page_detail->meta_key  = 'home-icon';
        $page_detail->meta_value = 'hello.jpg';

        $page_detail->save();


    }
}
