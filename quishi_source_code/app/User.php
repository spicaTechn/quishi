<?php

namespace App;

use App\Model\UserProfile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\Career, App\Model\Review;
use App\Model\Follower;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','provider','provider_id','sign_in_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    //a user have one user_profile

    public function user_profile(){
        return $this->hasOne('App\Model\UserProfile');
    }


    public function careers(){
        return $this->belongsToMany('App\Model\Career','user_career');
    }

    public function tags(){
        return $this->belongsToMany('App\Model\Tag','user_tag')->withTimestamps();
    }


    //a user (career seeker has many reviews)

    public function reviews(){
        return $this->hasMany(Review::class,'user_id');
    }

    public function forum_questions()
    {
        return $this->hasMany('App\Model\ForumQuestion');
    }

    public function forum_question_answers()
    {
        return $this->hasMany('App\Model\ForumQuestionAnswer');
    }

    //get the user links 

    public function user_links(){
        return $this->hasMany('App\Model\UserLink');
    }


    //users post the pages

    public function pages(){
        return $this->hasMany('App\Page');
    }


    //a user is followed by one to many users
    public function followers(){
        return $this->belongsToMany(User::class,'followers','leader_id','follower_id')->withTimestamps();
    }


    // a user can follow one to many users 

    public function following(){
        return $this->belongsToMany(User::class,'followers','follower_id','leader_id')->withTimestamps();
    }


    //number of blogs written by

    public function posts(){
        return $this->hasMany('App\Model\Post');
    }


    //function to return the admin users

    public function admin_users(){
        return $this->select('id')->where('logged_in_type','1')->get();
    }


}
