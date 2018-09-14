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

Route::group(['middleware'=>array('auth','userType')],function(){
	Route::get('/profile', 'Front\CareerAdvisor\CareerAdvisorController@profile')->name('profile');
	Route::get('/profileLogin', 'Front\CareerAdvisor\CareerAdvisorController@profileLogin');
	Route::get('/profileAccount', 'Front\CareerAdvisor\CareerAdvisorController@profileAccount');
	Route::get('/profileSetupOne', 'Front\CareerAdvisor\CareerAdvisorController@profileSetupOne');
	Route::get('/profileSetupTwo', 'Front\CareerAdvisor\CareerAdvisorController@profileSetupTwo');
	Route::get('/profileSetupThree', 'Front\CareerAdvisor\CareerAdvisorController@profileSetupThree');
	Route::get('/questionAdminReview', 'Front\CareerAdvisor\CareerAdvisorController@questionAdminReview');
	Route::get('/questionAnsEdit', 'Front\CareerAdvisor\CareerAdvisorController@questionAnsEdit');
});



//route to the dashboard
//we have make this access only for the logged in user of the having the super admin role

Route::group(['prefix'=>'/admin','middleware'=>array('auth','userRole')],function(){
	Route::get('/', [
        'as'        =>'admin.dashboard',
        'uses'      =>'Admin\DashboardController@index'
	]);

	Route::get('/industryJobs', [
	        'as'        =>'admin.industryJobs',
	        'uses'      =>'Admin\Industry\IndustryController@index'
	]);

	Route::post('/industryJobs',[
			'as'        => 'admin.add.industryJobs',
			'uses'		=> 'Admin\Industry\IndustryController@store'
	]);
	//show the careers by id

	Route::get('/industry',[
		'as'		=> 'admin.industry',
		'uses'		=> 'Admin\Industry\IndustryController@getCareerIndustry'
	]);

	Route::get('/industryJobs/{id}',[
		'as'        => 'admin.get.industryJobs',
		'uses'		=> 'Admin\Industry\IndustryController@show'
	]);


	Route::post('/industryJobs/{id}',[
		'as'		=> 'admin.update.industryJobs',
		'uses'		=> 'Admin\Industry\IndustryController@update'
	]);

	// Route for pages(about, contact etc)
	Route::get('/cms/pages', [
		'as'		=>	'admin.cms.pages',
		'uses'		=>	'Admin\Cms\Pages\PagesController@index'
	]);
	// Route to store about page top section content to quishi
	Route::post('/cms/pages/aboutUpdate/{id}', [
		'as'		=>	'admin.cms.pages.aboutUpdate',
		'uses'		=>	'Admin\Cms\Pages\PagesController@aboutUpdate'
	]);

	// route related to the industry datatable

	Route::delete('/industryJobs/{id}',[
		'as'	    => 'admin.delete.industryJobs',
		'uses'		=> 'Admin\Industry\IndustryController@destroy'
	]);

	//route related to the industry datatable

	Route::get('/industry/getIndustry',[
		'as'         => 'admin.industry.getIndustry',
		'uses'	     => 'Admin\Industry\IndustryController@getIndustry'
	]);

	Route::get('/jobs/getJobs',[
		'as'		=> 'admin.jobs.getJobs',
		'uses'      => 'Admin\Industry\IndustryController@getJobs'
	]);


	// Route related to question
	Route::get('/question', [
	        'as'        =>'admin.question',
	        'uses'      =>'Admin\Question\QuestionController@index'
	]);

	// Route related to education
	Route::get('/education', [
	        'as'        =>'admin.education',
	        'uses'      =>'Admin\Education\EducationController@index'
	]);
});


Auth::routes();




Route::get('/home', function(){
	return redirect()->route('profile');
});


// Route related to users


Route::get('/admin/user', [
        'as'        =>'admin.user',
        'uses'      =>'Admin\User\UserController@index'
]);

Auth::routes();



Route::get('/register/verify/{email}/{token}',function(){
		return view('quishi_login.emailConfirmation')->with(['callback_url'=>'https://google.com/lamanoj11@gmail.com']);
});
