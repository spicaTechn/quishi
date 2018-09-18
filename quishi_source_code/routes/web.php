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
//we have make this access only for the logged in user of the having the super admin role
Route::get('/admin', [
        'as'        =>'admin.dashboard',
        'uses'      =>'Admin\DashboardController@index'
]);

Route::get('/admin/industryJobs', [
        'as'        =>'admin.industryJobs',
        'uses'      =>'Admin\Industry\IndustryController@index'
]);

Route::post('/admin/industryJobs',[
		'as'        => 'admin.add.industryJobs',
		'uses'		=> 'Admin\Industry\IndustryController@store'
]);
//show the careers by id


Route::get('/admin/industry',[
	'as'		=> 'admin.industry',
	'uses'		=> 'Admin\Industry\IndustryController@getCareerIndustry'
]);

Route::get('/admin/industryJobs/{id}',[
	'as'        => 'admin.get.industryJobs',
	'uses'		=> 'Admin\Industry\IndustryController@show'
]);


Route::post('/admin/industryJobs/{id}',[
	'as'		=> 'admin.update.industryJobs',
	'uses'		=> 'Admin\Industry\IndustryController@update'
]);

// Route for pages(about, contact etc)
Route::get('/admin/cms/pages', [
	'as'		=>	'admin.cms.pages',
	'uses'		=>	'Admin\Cms\Pages\PagesController@index'
]);
// Route to store about page top section content to quishi
Route::post('/admin/cms/pages/aboutUpdate/{about}', [
	'as'		=>	'admin.cms.pages.aboutUpdate',
	'uses'		=>	'Admin\Cms\Pages\PagesController@aboutUpdate'
]);

// Route to get about us our team
Route::get('/admin/cms/pages/editOurTeam/{id}', [
	'as'		=>	'admin.cms.pages.editOurTeam',
	'uses'		=>	'Admin\Cms\Pages\PagesController@editOurTeam'
]);
Route::post('/admin/cms/pages/updateOurTeam/{id}', [
	'as'		=>	'admin.cms.pages.updateOurTeam',
	'uses'		=>	'Admin\Cms\Pages\PagesController@updateOurTeam'
]);
Route::post('/admin/cms/pages/deleteOurTeam/{id}', [
	'as'		=>	'admin.cms.pages.deleteOurTeam',
	'uses'		=>	'Admin\Cms\Pages\PagesController@deleteOurTeam'
]);

// Route to store about us our team
Route::post('/admin/cms/pages/ourTeam', [
	'as'		=>	'admin.cms.pages.ourTeam',
	'uses'		=>	'Admin\Cms\Pages\PagesController@store'
]);

// route related to the industry datatable

Route::delete('/admin/industryJobs/{id}',[
	'as'	    => 'admin.delete.industryJobs',
	'uses'		=> 'Admin\Industry\IndustryController@destroy'
]);

//route related to the industry datatable

Route::get('/admin/industry/getIndustry',[
	'as'         => 'admin.industry.getIndustry',
	'uses'	     => 'Admin\Industry\IndustryController@getIndustry'
]);

Route::get('/admin/jobs/getJobs',[
	'as'		=> 'admin.jobs.getJobs',
	'uses'      => 'Admin\Industry\IndustryController@getJobs'
]);

// Route related to question


Route::get('/admin/question', [
        'as'        =>'admin.question',
        'uses'      =>'Admin\Question\QuestionController@index'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
