<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Front\MainPageController@index');

Route::get('/about', 'Front\AboutPageController@index');
Route::get('/contact', 'Front\ContactPageController@index');


//route to the dashboard
Route::get('/admin', [
        'as'        =>'admin.dashboard',
        'uses'      =>'Admin\DashboardController@index'
]);

Route::get('/admin/industry-and-jobs', [
        'as'        =>'admin.industryJobs',
        'uses'      =>'Admin\IndustryController@index'
]);




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
