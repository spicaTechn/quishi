<?php

namespace App;

use App\Model\UserProfile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\Career, App\Model\Review;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
        return $this->belongsToMany('App\Model\Tag','user_tag');
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

}
