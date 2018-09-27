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
Route::get('/contact',[
	'as'	=>	'contact',
	'uses'	=>	'Front\ContactPageController@index'

]);
// route for in the media
Route::get('/blog', [
	'as'		=>	'blog',
	'uses'		=>	'Front\BlogPageController@index'
]);
// Route for profile front
Route::get('/career-advisior','Front\ProfilePageController@index');
// route for showing single profile
Route::get('/career-advisior/{id}', [
	'as'		=>	'career-advisior',
	'uses'		=>	'Front\ProfilePageController@viewProfile'
]);

// Route for profile

Route::group(['middleware'=>array('auth','userType'),'prefix'=>'/profile'],function(){

	//profile routes
	Route::any('/', 'Front\CareerAdvisor\Profile\ProfileController@index')->name('profile')->middleware('userProfile');
	Route::get('/profileLogin', 'Front\CareerAdvisor\Profile\ProfileController@profileLogin');
	Route::get('/profileAccount', 'Front\CareerAdvisor\Profile\ProfileController@profileAccount');
	Route::any('/setup/step1', 'Front\CareerAdvisor\Profile\ProfileController@profileSetupOne')->name('profile.setup.step1');
	Route::any('/setup/step2', 'Front\CareerAdvisor\Profile\ProfileController@profileSetupTwo')->name('profile.setup.step2');
	Route::post('/setup/complete', 'Front\CareerAdvisor\Profile\ProfileController@completeSetup')->name('complete.profile');
	Route::any('/setup/step3', 'Front\CareerAdvisor\Profile\ProfileController@profileSetupThree')->name('profile.setup.step3');

	//reviews route
	Route::get('/reviews', 'Front\CareerAdvisor\Reviews\ReviewsController@index');

	//answers route
	Route::get('/answers', 'Front\CareerAdvisor\Answer\AnswerController@index');

	//edit user answer

	Route::get('/answers/{answer_id}',[
		'as'		=> 'show.CareerAdvisor.answer',
		'uses' 		=> 'Front\CareerAdvisor\Answer\AnswerController@show'
	]);

	//delete user answer

	Route::delete('/answers/{answer_id}',[
		'as'		=> 'destroy.CareerAdvisor.answer',
		'uses'		=> 'Front\CareerAdvisor\Answer\AnswerController@destroy'
	]);




	//get the job title by the parent industry for the job seeker
	Route::get('/getChildJobByParentIndustry',[
		'as'		=> 'jobTitleByParent',
		'uses'		=> 'Front\CareerAdvisor\BaseCareerAdvisorController@getJobByIndustryId'
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
	Route::any('/cms/pages/aboutUpdate/', [
		'as'		=>	'admin.cms.pages.aboutUpdate',
		'uses'		=>	'Admin\Cms\Pages\PagesController@aboutUpdate'
	]);

	// Route to store about page top section content to quishi
	Route::post('/cms/pages/aboutUpdate/{about}', [
		'as'		=>	'admin.cms.pages.aboutUpdate',
		'uses'		=>	'Admin\Cms\Pages\PagesController@aboutUpdate'
	]);

	// Route to store contac page  content to quishi
	Route::post('/cms/pages/contactUpdate/', [
		'as'		=>	'admin.cms.pages.contactUpdate',
		'uses'		=>	'Admin\Cms\Pages\PagesController@contactUpdate'
	]);

	// Route to store contact content to quishi
	Route::post('/cms/pages/contactUpdate/{id}', [
		'as'		=>	'admin.cms.pages.contactUpdate',
		'uses'		=>	'Admin\Cms\Pages\PagesController@contactUpdate'
	]);


	Route::post('/cms/pages/contactSocialUpdate/{id}', [
		'as'		=>	'admin.cms.pages.contactSocialUpdate',
		'uses'		=>	'Admin\Cms\Pages\PagesController@contactSocialUpdate'
	]);
	// Route to store contact content to quishi

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




	// route for blog page
	Route::get('/cms/blog', [
		'as'		=>	'admin.cms.blog',
		'uses'		=>	'Admin\Cms\Blog\BlogController@index'
	]);

	Route::post('/cms/blog', [
		'as'		=>	'admin.cms.blog',
		'uses'		=>	'Admin\Cms\Blog\BlogController@store'
	]);
	Route::get('/cms/blog/editBlog/{id}', [
		'as'		=>	'admin.cms.blog.editBlog',
		'uses'		=>	'Admin\Cms\Blog\BlogController@editBlog'
	]);
	Route::post('/cms/blog/updateBlog/{id}', [
		'as'		=>	'admin.cms.blog.updateBlog',
		'uses'		=>	'Admin\Cms\Blog\BlogController@updateBlog'
	]);
	Route::post('/cms/blog/{id}',[
		'as'   => 'delete.blog',
		'uses' => 'Admin\Cms\Blog\BlogController@destroy'
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

	

	Route::get('/users', [
        'as'        =>'admin.users',
        'uses'      =>'Admin\User\UserController@index'
	]);


	Route::post('/users/update',[
		'as'	=> 'admin.users.update',
		'uses'	=> 'Admin\User\UserController@update'
	]);

	//get admin reviews to users
	Route::get('/users/admin/reviews',[
		'as'		=> 'admin.users.admin_reviews',
		'uses'		=> 'Admin\User\UserController@showAdminReviews'
	]);


	//get the career advisior only

	Route::get('/users/careerAdvisior',[
		'as'	=> 'admin.careerAdvisior',
		'uses'	=> 'Admin\User\UserController@getCareerAdvisor'
	]);


	Route::post('/users/reviews/',[
		'as' 		=> 'admin.careerAdvisior.reviews',
		'uses' 		=> 'Admin\User\UserController@createReview'
	]);


	Route::post('/users/reviews/changeStatus',[
		'as'	=> 'admin.reviews.changeStatus',
		'uses'  => 'Admin\user\UserController@updateCareerReviewStatus'
	]);


	
	Route::get('/userProfile', [
	        'as'        =>'admin.userProfile',
	        'uses'      =>'Admin\UserProfile\UserProfileController@index'
	]);

	// Route related to education
	Route::get('/educations', [
	        'as'        =>'admin.educations',
	        'uses'      =>'Admin\Education\EducationController@index'
	]);


	//store the education major cateogry and education major
	Route::post('/educations',[
		'as'		=> 'admin.educations.store',
		'uses'		=> 'Admin\Education\EducationController@store'
	]);


	Route::get('/educations/majorCategory',[
		'as'	=> 'admin.educations.getMajorCategory',
		'uses'	=> 'Admin\Education\EducationController@getMajorCategory'
	]);

	Route::get('/educations/getMajorCategory',[
		'as'	=> 'admin.educations.majorCategory',
		'uses'	=> 'Admin\Education\EducationController@getEducationMajorCategory'
	]);

	Route::get('/educations/getMajor',[
		'as'	=> 'admin.educations.major',
		'uses'	=> 'Admin\Education\EducationController@getEducationMajor'
	]);

	//show education major category and education major
	Route::get('/educations/{id}',[
		'as'	=> 'admin.educations.show',
		'uses'  => 'Admin\Education\EducationController@show'
	]);

	//update education major category and education major

	Route::post('/educations/{id}',[
		'as'	=> 'admin.educations.update',
		'uses'  => 'Admin\Education\EducationController@update'
	]);

});

// Route for inquiry Message of contact page
Route::post('/contact/inquiry', [
	'as'	=>'contact.inquiry',
	'uses'	=>'Front\ContactPageController@store'
]);


Auth::routes();

Route::get('/home', function(){
	return redirect()->route('profile');
});


// Route related to users

Auth::routes();

Route::get('/register/verify/{email}/{token}',function(){
		return view('quishi_login.emailConfirmation')->with(['callback_url'=>'https://google.com/lamanoj11@gmail.com']);
});

// //frontends

// Route::get('/career-advisior/{id}',[
// 	'as'	=> 'show.career-advisior',
// 	//'uses'	=> 'Front\'
// ]);
