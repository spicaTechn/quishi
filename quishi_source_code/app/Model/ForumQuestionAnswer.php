<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ForumQuestion;


class ForumQuestionAnswer extends Model
{
    //
    protected $table = 'forum_question_answer';

    public function forum_question(){
        return $this->belongsTo('App\Model\ForumQuestion');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function answer_poster(){
        return $this->belongsTo('App\User','posted_by','id');
    }

    public function childern(){
    	return $this->hasMany('App\Model\ForumQuestionAnswer','parent','id');

    }


    //echo education major may have one education major category
    public function parent_answer(){
    	return $this->hasOne('App\Model\ForumQuestionAnswer','id','parent');

    }

}
