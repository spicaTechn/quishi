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

// Route for profile
Route::get('/profile', 'Front\CareerAdvisor\CareerAdvisorController@profile');
Route::get('/profileLogin', 'Front\CareerAdvisor\CareerAdvisorController@profileLogin');
Route::get('/profileAccount', 'Front\CareerAdvisor\CareerAdvisorController@profileAccount');
Route::get('/profileSetupOne', 'Front\CareerAdvisor\CareerAdvisorController@profileSetupOne');
Route::get('/profileSetupTwo', 'Front\CareerAdvisor\CareerAdvisorController@profileSetupTwo');
Route::get('/profileSetupThree', 'Front\CareerAdvisor\CareerAdvisorController@profileSetupThree');
Route::get('/questionAdminReview', 'Front\CareerAdvisor\CareerAdvisorController@questionAdminReview');
Route::get('/questionAnsEdit', 'Front\CareerAdvisor\CareerAdvisorController@questionAnsEdit');


//route to the dashboard
Route::get('/admin', 'Admin\DashboardController@index');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
