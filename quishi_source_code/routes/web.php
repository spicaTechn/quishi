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

Route::group(['middleware'=>array('auth','userType'),'prefix'=>'/profile'],function(){
	Route::any('/', 'Front\CareerAdvisor\CareerAdvisorController@profile')->name('profile')->middleware('userProfile');
	Route::get('/profileLogin', 'Front\CareerAdvisor\CareerAdvisorController@profileLogin');
	Route::get('/profileAccount', 'Front\CareerAdvisor\CareerAdvisorController@profileAccount');
	Route::any('/setup/step1', 'Front\CareerAdvisor\CareerAdvisorController@profileSetupOne')->name('profile.setup.step1');
	Route::any('/setup/step2', 'Front\CareerAdvisor\CareerAdvisorController@profileSetupTwo')->name('profile.setup.step2');
	Route::post('/setup/complete', 'Front\CareerAdvisor\CareerAdvisorController@completeSetup')->name('complete.profile');
	Route::any('/setup/step3', 'Front\CareerAdvisor\CareerAdvisorController@profileSetupThree')->name('profile.setup.step3');
	Route::get('/questionAdminReview', 'Front\CareerAdvisor\CareerAdvisorController@questionAdminReview');
	Route::get('/questionAnsEdit', 'Front\CareerAdvisor\CareerAdvisorController@questionAnsEdit');


	//get the job title by the parent industry for the job seeker
	Route::get('/getChildJobByParentIndustry',[
		'as'		=> 'jobTitleByParent',
		'uses'		=> 'Front\CareerAdvisor\CareerAdvisorController@getJobByIndustryId'
	]);

	Route::get('/tags',[
		'as'	=> 'tags.all',
		'uses'	=> 'Front\CareerAdvisor\TagController@index'
	]);
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
	Route::get('/questions', [
	        'as'        =>'admin.question',
	        'uses'      =>'Admin\Question\QuestionController@index'
	]);


	Route::post('/questions',[
		'as'		=> 'admin.add.question',
		'uses'		=>  'Admin\Question\QuestionController@store'
	]);


	Route::post('/questions/{id}',[
		'as'		=> 'update.question',
		'uses'		=> 'Admin\Question\QuestionController@update'
	]);


// Route for pages(about, contact etc)
Route::get('/cms/pages', [
	'as'		=>	'admin.cms.pages',
	'uses'		=>	'Admin\Cms\Pages\PagesController@index'
]);
// Route to store about page top section content to quishi
Route::post('/cms/pages/aboutUpdate/{about}', [
	'as'		=>	'admin.cms.pages.aboutUpdate',
	'uses'		=>	'Admin\Cms\Pages\PagesController@aboutUpdate'
]);

// Route to get about us our team
Route::get('/cms/pages/editOurTeam/{id}', [
	'as'		=>	'admin.cms.pages.editOurTeam',
	'uses'		=>	'Admin\Cms\Pages\PagesController@editOurTeam'
]);
Route::post('/cms/pages/updateOurTeam/{id}', [
	'as'		=>	'admin.cms.pages.updateOurTeam',
	'uses'		=>	'Admin\Cms\Pages\PagesController@updateOurTeam'
]);
Route::post('/cms/pages/deleteOurTeam/{id}', [
	'as'		=>	'admin.cms.pages.deleteOurTeam',
	'uses'		=>	'Admin\Cms\Pages\PagesController@deleteOurTeam'
]);

// Route to store about us our team
Route::post('/cms/pages/ourTeam', [
	'as'		=>	'admin.cms.pages.ourTeam',
	'uses'		=>	'Admin\Cms\Pages\PagesController@store'
]);

// route related to the industry datatable


	Route::delete('/questions/{id}',[
		'as'	 => 'delete.questions',
		'uses'   => 'Admin\Question\QuestionController@destroy'
	]);


	Route::get('/questions/getQuestions',[
		'as'           => 'admin.question.getQuestions',
		'uses'         => 'Admin\Question\QuestionController@getQuestions'
	]);

	Route::get('/questions/{id}', [
	        'as'        =>'show.question',
	        'uses'      =>'Admin\Question\QuestionController@show'
	]);


	//get the industry jobs like Graphics Designer - IT and Telecommunicatons
	Route::get('/jobs/getParentChildJobs',[
		'as'			=> 'admin.getIndustryJobs',
		'uses'          => 'Admin\Industry\IndustryController@getIndustryJobs'

    ]);
	// Route related to education
	Route::get('/educations', [
	        'as'        =>'admin.educations',
	        'uses'      =>'Admin\Education\EducationController@index'
	]);

	Route::get('/users', [
        'as'        =>'admin.users',
        'uses'      =>'Admin\User\UserController@index'
	]);
});


Auth::routes();

Route::get('/home', function(){
	return redirect()->route('profile');
});


// Route related to users

Auth::routes();

Route::get('/register/verify/{email}/{token}',function(){
		return view('quishi_login.emailConfirmation')->with(['callback_url'=>'https://google.com/lamanoj11@gmail.com']);
});

//frontends 

Route::get('/career-advisior/{id}',[
	'as'	=> 'show.career-advisior',
	//'uses'	=> 'Front\'
]);
