<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ForumQuestion extends Model
{
    //
    protected $table = 'forum_questions';

    public function forum_question_answers()
    {
    	return $this->hasMany('App\Model\ForumQuestionAnswer');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

}
