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


// All Route for pages
	Route::get('/', 'Front\MainPageController@index');

	Route::get('/about', 'Front\Pages\About\AboutPageController@index');
	Route::get('/privacy-policy', 'Front\MainPageController@privacy');
	Route::get('/terms-and-condition', 'Front\MainPageController@terms');
	Route::get('/contact',[
		'as'	=>	'contact',
		'uses'	=>	'Front\Pages\Contact\ContactPageController@index'

	]);
	// route for in the media
	Route::get('/blog', [
		'as'		=>	'blog',
		'uses'		=>	'Front\Pages\Blog\BlogPageController@index'
	]);


	Route::get('/media',[
		'as'      => 'media',
		'uses'    => 'Front\Pages\Blog\BlogPageController@media'
	]);


	Route::get('/blog/careerAdvisor/{id}/{name}',[
		'as'		=> 'careerAdvisior.blog.index',
		'uses'      => 'Front\Pages\Blog\BlogPageController@showCareerAdvisiorBlog'
	]);
	Route::get('/blog/{id}/{slug}', [
		'as'		=>	'blog',
		'uses'		=>	'Front\Pages\Blog\BlogPageController@show'
	]);

	Route::get('/blog-share/{user_id}/{blog_id}','Front\Pages\Blog\BlogShareController@show');

	// Route for profile front
	Route::get('/career-advisor','Front\Pages\Profile\ProfilePageController@index');
	// route for showing single profile
	Route::get('/career-advisor/{id}/{name}', [
		'as'		=>	'career-advisior',
		'uses'		=>	'Front\Pages\Profile\ProfilePageController@show'
	]);
	Route::post('/career-advisior/{id}',[
		'as'	=>	'career-advisior.like',
		'uses'  =>  'Front\Pages\Profile\ProfilePageController@update'
	]);

	Route::get('/loadMoreCareer',[
		'as'	=>	'loadMoreCareer',
		'uses'  =>  'Front\Pages\Profile\ProfilePageController@loadMoreCareer'
	]);

	// route for forum page
	Route::get('/forums', [
		'as'		=>	'forum',
		'uses'		=>	'Front\Pages\Forum\ForumPageController@index'
	]);

	Route::post('/forums', [
		'as' 		=> 'forum.store',
		'uses'      => 'Front\Pages\Forum\ForumPageController@store'
	]);
	Route::get('/forums/{id}/{slug}', [
		'as'		=>	'forum.show',
		'uses'		=>	'Front\Pages\Forum\ForumPageController@show'
	]);

	Route::post('/forums/answer/', [
		'as'		=>	'forums.answer',
		'uses'		=>	'Front\Pages\Forum\ForumPageController@saveAnswer'
	]);
	Route::post('/forums/answer/reply', [
		'as'		=>	'forums.answer.reply',
		'uses'		=>	'Front\Pages\Forum\ForumPageController@saveAnswerReply'
	]);


	//users search on the index page

	Route::post('/searchByLocation',[
		'as'		=> 'searchByLocation.autocomplete',
		'uses'		=> 'Front\MainPageController@autocompleteByLocation'
	]);

	Route::post('/searchByJobTitle',[
		'as'		=> 'searchByJobTitle.autocomplete',
		'uses'		=> 'Front\MainPageController@autocompleteByJobTitle'
	]);


	//single profile page routes
	Route::post('/answers/plusLike',[
		'as'       => 'answers.increaseLikeCounter',
		'uses'     => 'Front\Pages\Profile\ProfileCommentController@increaseLikeCounter'
	]);

	Route::post('/answers/postComment',[
		'as'      => 'answers.postComment',
		'uses'    => 'Front\Pages\Profile\ProfileCommentController@createComment'
	]);

	Route::post('/answers/comments/plusLike',[
		'as'     => 'answers.comments.increaseLikeCounter',
		'uses'   =>'Front\Pages\Profile\ProfileCommentController@increaseCommentLikeCounter'
	]);

	Route::post('/answers/comments/postComment',[
		'as'     => 'answers.comments.increaseLikeCounter',
		'uses'   =>'Front\Pages\Profile\ProfileCommentController@createCommentReply'
	]);


	//single blog comment routes

	Route::post('/blogs/postComment',[
		'as'      => 'blogs.postComment',
		'uses'    => 'Front\Pages\Blog\BlogCommentController@createComment'
	]);

	Route::post('/blogs/comments/postComment',[
		'as'     => 'blogs.comments.postReply',
		'uses'   =>'Front\Pages\Blog\BlogCommentController@createCommentReply'
	]);

	Route::post('/blogs/comments/plusLike',[
		'as'     => 'answers.comments.increaseLikeCounter',
		'uses'   =>'Front\Pages\Blog\BlogCommentController@increaseCommentLikeCounter'
	]);


	//single forum answer routes

	Route::post('/forums/postAnswer',[
		'as'    => 'forums.postAnswer',
		'uses'  => 'Front\Pages\Forum\ForumAnswerController@createAnswer'
	]);

	Route::post('/forums/answers/plusLike',[
		'as'     => 'fourms.answers.increaseLikeCounter',
		'uses'   =>'Front\Pages\Forum\ForumAnswerController@increaseAnswerLikeCounter'
	]);

	Route::post('/forums/answers/postReply',[
		'as'     => 'forums.answers.postReply',
		'uses'   =>'Front\Pages\Forum\ForumAnswerController@createAnswerReply'
	]);

	Route::post('/forums/questions/like',[
		'as'    => 'forums.questions.like',
		'uses'  => 'Front\Pages\Forum\ForumAnswerController@increaseForumQuestionLike'
	]);



// Route for profile

Route::group(['middleware'=>array('auth','userType'),'prefix'=>'/profile'],function(){

	//profile routes
	Route::any('/', 'Front\CareerAdvisor\Profile\ProfileController@index')->name('profile')->middleware('userProfile');
	Route::get('/profileLogin', 'Front\CareerAdvisor\Profile\ProfileController@profileLogin');
	Route::get('/profileAccount', 'Front\CareerAdvisor\Profile\ProfileController@profileAccount');

	//route realted to the profile setup step1
	Route::any('/setup/step1', 'Front\CareerAdvisor\Profile\ProfileController@profileSetupOne')->name('profile.setup.step1');

	//back button implemented here 
	Route::get('/setup/step1/back','Front\CareerAdvisor\Profile\ProfileController@backToStepOne')->name('profile.setup.step1.back');

	Route::any('/setup/step2', 'Front\CareerAdvisor\Profile\ProfileController@profileSetupTwo')->name('profile.setup.step2');


	Route::get('/setup/step2/back','Front\CareerAdvisor\Profile\ProfileController@backToStepTwo')->name('profile.setup.step2.back');


	Route::get('/setup/getMajor','Front\CareerAdvisor\Profile\ProfileController@getMajor');
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

	Route::get('/answers/show/{answer_id}',[
		'as'		=> 'careerAdvisior.answer.show',
		'uses'		=> 'Front\CareerAdvisor\Answer\AnswerController@show'
	]);

	Route::post('/answers/{answer_id}',[
		'as'		=> 'careerAdvisior.answer.update',
		'uses'		=> 'Front\CareerAdvisor\Answer\AnswerController@update'
	]);


	//my account section

	Route::get('/my-account',[
		'as'		=> 'careerAdvisior.my-account.index',
		'uses'		=> 'Front\CareerAdvisor\Profile\MyAccountController@index'
	]);



	Route::get('/my-account/change-password',[
		'as'	=> 'profile.my-account.change-password',
		'uses'  => 'Front\CareerAdvisor\Profile\MyAccountController@change_logged_in_user_password'
	]);


	Route::post('/my-account/change-advisior-password',[
		'as'	=> 'profile.my-account.reset-password',
		'uses'  => 'Front\CareerAdvisor\Profile\MyAccountController@change_password'
	]);

	Route::post('/my-account/{id}',[
		'as'		=> 'profile.my-account.udpate',
		'uses'		=> 'Front\CareerAdvisor\Profile\MyAccountController@update'
	]);



	//follow /  unfollow the career advisor

	Route::post('/followCareerAdvisor/{id}',[
		'as'	  => 'profile.follow.careerAdvisor',
		'uses'	  => 'Front\CareerAdvisor\Follower\FollowerController@followCareerAdvisor'
	]);


	Route::post('/unfollowCareerAdvisor/{id}',[
		'as'	=> 'profile.unfollow.careerAdvisor',
		'uses'	=> 'Front\CareerAdvisor\Follower\FollowerController@unfollowCareerAdvisor'
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


	//save or update career advisior links
	Route::post('/links',[
		'as'   	=> 'profile.links.udpate',
		'uses'  => 'Front\CareerAdvisor\Profile\ProfileController@udpate_advisior_links'
	]);


	Route::delete('/links/{id}',[
		'as'	=> 'profile.links.destroy',
		'uses'	=> 'Front\CareerAdvisor\Profile\ProfileController@delete_user_link'
	]);


	Route::post('/links/store',[
		'as'	=> 'profile.links.store',
		'uses'	=> 'Front\CareerAdvisor\Profile\ProfileController@create_user_link'
	]);

	//blog section for the blog 

	Route::get('/blogs',[
		'as'	=> 'profile.blog.index',
		'uses'	=> 'Front\CareerAdvisor\Blog\BlogController@index'
	]);

	Route::get('/blogs/create',[
		'as'	=> 'profile.blog.create',
		'uses'	=> 'Front\CareerAdvisor\Blog\BlogController@create'
	]);


	Route::get('/blogs/{id}',[
		'as'	=> 'profile.blog.show',
		'uses'  => 'Front\CareerAdvisor\Blog\BlogController@show'
	]);

	//store the career advisior blog

	Route::post('/blogs',[
		'as'	=> 'profile.blog.store',
		'uses'	=> 'Front\CareerAdvisor\Blog\BlogController@store'
	]);

	Route::post('/blogs/{id}',[
		'as'	=> 'profile.blog.update',
		'uses'  => 'Front\CareerAdvisor\Blog\BlogController@update'
	]);

	Route::delete('/blogs/{id}',[
		'as'    => 'profile.blog.destroy',
		'uses'  => 'Front\CareerAdvisor\Blog\BlogController@destroy'
	]);



	//notifications

	Route::post('/notifications/markAsSeen',[
		'as'	=> 'notification.markAsSeen',
		'uses'  => 'Front\CareerAdvisor\Notification\NotificationController@markAsSeen'
	]);

	//route to mark the notification as the read notification

	Route::post('/notifications/markAsRead',[
		'as'   => 'notification.markAsRead',
		'uses' => 'Front\CareerAdvisor\Notification\NotificationController@markAsRead'
	]);


	Route::post('/notifications/markAllAsRead',[
	  'as'	  => 'profile.markAllAsRead',
	  'uses'  => 'Front\CareerAdvisor\Notification\NotificationController@markAllAsRead'
	]);

	//show the followers and following the logged in career adviser

	Route::get('/following',[
		'as'      => 'careerAdviser.following',
		'uses'    => 'Front\CareerAdvisor\Following\FollowingController@index'
	]);


	Route::get('/followers',[
		'as'     => 'careerAdviser.followers',
		'uses'   => 'Front\CareerAdvisor\Follower\FollowerController@index'
	]);



});






//route to the dashboard
//we have make this access only for the logged in user of the having the super admin role

Route::group(['prefix'=>'/admin','middleware'=>array('auth','userRole')],function(){
	Route::get('/', [
        'as'        =>'admin.dashboard',
        'uses'      =>'Admin\Dashboard\DashboardController@index'
	]);

	//get the user chart ratio

	Route::get('/users/userChartRatio',[
		'as'		 => 'admin.users.monthlyChart',
		'uses'		 => 'Admin\Dashboard\DashboardController@showMonthlyUserRegistrationRatio'
	]);

	Route::get('/industryJobs', [
	        'as'        =>'admin.industryJobs',
	        'uses'      =>'Admin\Industry\IndustryController@index'
	]);

	Route::post('/industryJobs',[
			'as'        => 'admin.add.industryJobs',
			'uses'		=> 'Admin\Industry\IndustryController@store'
	]);


	//prevent the industryJobs title dublication 

	Route::get('/industryJobs/checkIndustryTitle',[
		'as'		  => 'admin.industryJobs.checkIndustryTitle',
		'uses'	      => 'Admin\Industry\IndustryController@checkIndustryTitle'
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
	// Route for home page content

	Route::get('/cms/pages/editHome/{id}', [
		'as'		=>	'admin.cms.pages.editHome',
		'uses'		=>	'Admin\Cms\Pages\PagesController@editHome'
	]);

	Route::post('/cms/pages/homeUpdate/{id}', [
		'as'		=>	'admin.cms.pages.homeUpdate',
		'uses'		=>	'Admin\Cms\Pages\PagesController@homeUpdate'
	]);
	Route::post('/cms/pages/homeVideoIdUpdate/{id}', [
		'as'		=>	'admin.cms.pages.homeVideoIdUpdate',
		'uses'		=>	'Admin\Cms\Pages\PagesController@homeVideoIdUpdate'
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
    
    // **********************************
    // Route to store terms and condition
    
	Route::post('/cms/pages/termsConditions', [
		'as'		=>	'admin.cms.pages.termsConditions',
		'uses'		=>	'Admin\Cms\Pages\PagesController@storeTerms'
	]);
    
    Route::get('/cms/pages/editTerm/{term_id}/{page_id}', [
		'as'		=>	'admin.cms.pages.editTerm',
		'uses'		=>	'Admin\Cms\Pages\PagesController@editTerm'
	]);


	Route::post('/cms/pages/updateTerm',[
		'as'        => 'admin.cms.pages.udpateTerm',
		'uses'      => 'Admin\Cms\Pages\PagesController@updateTerm'
	]);

	Route::post('/cms/pages/deleteTerm',[
		'as'       => 'admin.cms.pages.deleteTerm',
		'uses'     => 'Admin\Cms\Pages\PagesController@deleteTerm'
	]);
    
    // *****************************
    // Route to store Privacy Policy
	Route::post('/cms/pages/privacyPolicy', [
		'as'		=>	'admin.cms.pages.PrivacyPolicy',
		'uses'		=>	'Admin\Cms\Pages\PagesController@storePrivacyPolicy'
	]);
    
    Route::get('/cms/pages/editPrivacyPolicy/{privacy_policy_id}/{page_id}', [
		'as'		=>	'admin.cms.pages.editPrivacyPolicy',
		'uses'		=>	'Admin\Cms\Pages\PagesController@editPrivacyPolicy'
	]);


	Route::post('/cms/pages/updatePrivacyPolicy',[
		'as'        => 'admin.cms.pages.udpatePrivacyPolicy',
		'uses'      => 'Admin\Cms\Pages\PagesController@updatePrivacyPolicy'
	]);

	Route::post('/cms/pages/deletePrivacyPolicy',[
		'as'       => 'admin.cms.pages.deletePrivacyPolicy',
		'uses'     => 'Admin\Cms\Pages\PagesController@deletePrivacyPolicy'
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


	//check for the title exists or not
	Route::get('/education/checkEducationTitle',[
		'as'	=> 'admin.education.checkEducationTitle',
		'uses'  => 'Admin\Education\EducationController@checkEducationTitle'
	]);

	//update education major category and education major

	Route::post('/educations/{id}',[
		'as'	=> 'admin.educations.update',
		'uses'  => 'Admin\Education\EducationController@update'
	]);

	//delete the education by the id

	Route::delete('/educations/{id}',[
		'as'	=> 'admin.educations.destroy',
		'uses'	=> 'Admin\Education\EducationController@destroy'
	]);


	//route that are related to locations 

	Route::get('/locations',[
		'as'   => 'admin.locations.index',
		'uses' => 'Admin\Location\LocationController@index'
	]);

	Route::get('/locations/getLocations',[
		'as'	=> 'admin.location.getLocations',
		'uses'  => 'Admin\Location\LocationController@getLocations'
	]);

	Route::get('/locations/{id}',[
		'as'	=> 'admin.location.edit',
		'uses'  => 'Admin\Location\LocationController@show'
	]);


	Route::post('/locations',[
		'as'  => 'admin.add.location',
		'uses'=> 'Admin\Location\LocationController@store'
	]);

	//edit the locations

	Route::post('/locations/getQueryResult',[
		'as'	=> 'admin.location.getSearchLocation',
		'uses'  => 'Admin\Location\LocationController@getSearchLocation'
	]);


	Route::post('/locations/{id}',[
		'as'	=> 'admin.update.location',
		'uses'  => 'Admin\Location\LocationController@update'
	]);


	Route::delete('/locations/{id}',[
		'as'	=> 'admin.destroy.location',
		'uses'  => 'Admin\Location\LocationController@destroy'
	]);



});

// Route for inquiry Message of contact page
Route::post('/contact/inquiry', [
	'as'	=>'contact.inquiry',
	'uses'	=>'Front\Pages\Contact\ContactPageController@store'
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



//route for the soical login

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


//payments routes

Route::post('makePayment','Front\MainPageController@makeDonationPayment')->name('makePayment');

Route::post('page_like','Front\Pages\Blog\BlogPageController@page_like')->name('page_like');

